<?php
namespace backend\controllers;

use backend\models\Csv;
use common\models\Filter;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginFormBackend;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'load-csv', 'gii', 'parser'],
                        'allow' => false,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionParser()
    {
        $cat = Url::to(Yii::$app->basePath . '/web/csv/category');
        $category = scandir($cat);
        $cat = Url::to(Yii::$app->basePath . '/web/csv/product');
        $product = scandir($cat);
        $cat = Url::to(Yii::$app->basePath . '/web/csv/filter');
        $filter = scandir($cat);
        $cat = Url::to(Yii::$app->basePath . '/web/csv/price');
        $price = scandir($cat);
        return $this->render('parser',
            ['category' => $category, 'product' => $product, 'filter' => $filter, 'price' => $price]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginFormBackend();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLoadCsv()
    {
        if (Yii::$app->request->post('folder') == 'price') {
            $load = $this->loaddata(Yii::$app->request->post('i'), Yii::$app->request->post('folder'),
                Yii::$app->request->post('line'));
        } elseif (Yii::$app->request->post('folder') == 'product') {
            $load = $this->loaddata(Yii::$app->request->post('i'), Yii::$app->request->post('folder'),
                Yii::$app->request->post('line'));
        } else {
            $load = $this->loaddata(Yii::$app->request->post('i'), Yii::$app->request->post('folder'));
        }
        return json_encode([
            'dir' => $load[0],
            'i' => $load[1],
            'time' => $load[2],
            'counter' => $load[3],
            /*'line' => $load[4]*/
        ]);

    }

    public function loaddata($i, $folder, $line = null)
    {
        $start_time = microtime(true);

        $conn = mysqli_connect(Yii::$app->params['host'], Yii::$app->params['user'], Yii::$app->params['password'],
            Yii::$app->params['database']);
        mysqli_query($conn, 'SET NAMES utf8');
        $sql = '';
        $insert = '';
        $insert2 = '';
        $price_id = array();
        $handle = null;

        switch ($folder) {
            case 'price' :
                $sql .= 'UPDATE ' . Yii::$app->db->tablePrefix . 'product SET price = CASE ';
                $cat = Url::to(Yii::$app->basePath . '/web/csv/' . $folder);
                $dir = scandir($cat);

                if (isset($dir[$i])) {
                    if (substr($dir[$i], -3) == 'csv') {

                        $handle = fopen($cat . '/' . $dir[$i], 'r');
                        fseek($handle, $line);

                        while (($data = fgetcsv($handle, 0, ';')) !== false) {
//                        if (trim($data[0]) == '') {
//                            continue;
//                        }

                            /* if ($line + 1000000 > ftell($handle)) {*/

                            //$data[1] = str_replace(' zł', '', $data[1]);
                            $data[1] = str_replace(',', '.', $data[1]);

                            $insert .= 'WHEN ID=' . $data[0] . ' THEN ' . $data[1] . ' ';
                            $insert2 .= $data[0];

                            if (strlen($insert . $insert2) > Yii::$app->params['QueryMaxSize']) {
                                $sql_temp = $sql;
                                $sql_temp .= $insert;
                                $sql_temp .= ' ELSE price END WHERE ID in (' . $insert2 . ')';
                                $insert = '';
                                $insert2 = '';
                                mysqli_query($conn, $sql_temp);
                                $price_id = array();
                                $sql_temp = '';
                            } else {
                                $insert2 .= ', ';
                            }

                            unset($data);
                            /* } else {
                                 $stop_time = microtime(true);

                                 $time = $stop_time - $start_time;
                                 $time = round($time, 2);

                                 return [$dir[$i], $i, $time, count($dir), ftell($handle)];
                             }*/
                        }

                        if (!empty($price_id)) {
                            $sql_temp .= ' ELSE price END WHERE ID in (' . implode(', ', $price_id) . ')';
                            mysqli_query($conn, $sql_temp);
                            $price_id = array();
                        }
                    }
                    mysqli_close($conn);
                } else {
                    exit;
                }
                break;
            case 'product' :

                ini_set("max_execution_time", "120");
                $sql .= 'INSERT INTO ' . Yii::$app->db->tablePrefix . 'product (`ID`, `categoryID`, `name`, `link`, `image`, `description`, `price`) VALUES ';
                $cat = Url::to(Yii::$app->basePath . '/web/csv/' . $folder);
                $dir = scandir($cat);

                if (isset($dir[$i])) {
                    if (substr($dir[$i], -3) == 'csv') {

                        $handle = fopen($cat . '/' . $dir[$i], 'r');

                        while (($data = fgetcsv($handle, 0, ';')) !== false) {
                            /*if (trim($data[0]) == '' || str_replace(' ', '', $data[0] == '')) {
                                continue;
                            }*/

                            if (isset($data[2])) {
                                $data[2] = str_replace('"', '\'', $data[2]);
                            }
                            if (isset($data[3])) {
                                $data[3] = str_replace('"', '\'', $data[3]);
                            }
                            if (isset($data[4])) {
                                $data[4] = str_replace('"', '\'', $data[4]);
                            }
                            if (isset($data[5])) {
                                $data[5] = str_replace('"', '\'', $data[5]);
                            }

                            $insert .= ' ("' . implode('", "', $data) . '")';

                            if (strlen($insert) < Yii::$app->params['QueryMaxSize']) {
                                $insert .= ',';
                            } else {
                                $sql_temp = $sql;
                                $sql_temp .= $insert;
                                $insert = '';
                                $sql_temp .= ' ON DUPLICATE KEY UPDATE categoryID=categoryID, name=name, link=link, image=image, description=description, price=price';


                                $result = mysqli_query($conn, $sql_temp);
                                if (false === $result) {
                                    echo "<pre>Debug: $sql_temp</pre>\m";
                                    printf("error: %s\n", mysqli_error($conn));
                                }
                                $sql_temp = '';
                            }
                        }

                        if ($insert != '') {

                            if (substr($insert, -1) == ',') {
                                $insert = substr($insert, 0, strlen($insert) - 1);
                            }
                            $sql_temp = $sql;
                            $sql_temp .= $insert;
                            $sql_temp .= ' ON DUPLICATE KEY UPDATE categoryID=categoryID, name=name, link=link, image=image, description=description, price=price';

                            $result = mysqli_query($conn, $sql_temp);
                            if (false === $result) {
                                echo "<pre>Debug: $sql_temp</pre>\m";
                                printf("error: %s\n", mysqli_error($conn));
                            }
                        }
                    }
                } else {
                    exit;
                }

                break;
            case ('category' || 'filter') :
                if ($folder == 'category') {
                    $sql .= 'INSERT INTO ' . Yii::$app->db->tablePrefix . 'category (`ID`, `parentID`, `name`, `seolink`, `primary_category_id`) VALUES ';
                } elseif ($folder == 'filter') {
                    $sql .= 'INSERT INTO ' . Yii::$app->db->tablePrefix . 'filter (`ID`, `categoryID`, `name`, `type`, `item`) VALUES ';
                }

                $cat = Url::to(Yii::$app->basePath . '/web/csv/' . $folder);
                $dir = scandir($cat);

                if (isset($dir[$i])) {
                    if (substr($dir[$i], -3) == 'csv') {

                        $handle = fopen($cat . '/' . $dir[$i], 'r');

                        while (($data = fgetcsv($handle, 0, ';')) !== false) {
                            if (trim($data[0]) == '') {
                                continue;
                            }

                            if ($folder == 'category') {
                                $data[2] = str_replace('"', '\'', $data[2]);
                            }
                            if ($folder == 'filter') {
                                $temp = array();

                                $temp[0] = (int)$data[0];

                                if (isset($data[1])) {
                                    $temp[1] = str_replace('"', '\'', $data[1]);
                                } else {
                                    $temp[1] = '';
                                }

                                $temp[2] = $data[2];

                                if (isset($data[3])) {
                                    if ($data[3] == 'combo') {
                                        $temp[3] = Filter::TYPE_COMBO;
                                    } elseif ($data[3] == 'check') {
                                        $temp[3] = Filter::TYPE_CHECK;
                                    } else {
                                        $temp[3] = 2;
                                    }
                                } else {
                                    $temp[3] = 2;
                                }

                                if (isset($data[4])) {
                                    $temp[4] = $data[4];
                                } else {
                                    $temp[4] = '';
                                }

                                $data = $temp;
                            }

                            $insert .= ' ("' . implode('", "', $data) . '")';

                            if (strlen($insert) < Yii::$app->params['QueryMaxSize']) {

                                $insert .= ',';
                            } else {
                                $sql_temp = $sql;
                                $sql_temp .= $insert;
                                $insert = '';

                                if ($folder == 'category') {
                                    $sql_temp .= ' ON DUPLICATE KEY UPDATE parentID=parentID, name=name, seolink=seolink, primary_category_id=primary_category_id';
                                } elseif ($folder == 'filter') {
                                    $sql_temp .= ' ON DUPLICATE KEY UPDATE categoryID=categoryID, name=name, type=type, item=item';
                                }


                                mysqli_query($conn, $sql_temp);
                                $sql_temp = '';
                            }

                            unset($data);
                        }

                        if ($insert != '') {
                            if (substr($insert, -1) == ',') {
                                $insert = substr($insert, 0, strlen($insert) - 1);
                            }
                            $sql_temp = $sql;
                            $sql_temp .= $insert;
                            if ($folder == 'category') {
                                $sql_temp .= ' ON DUPLICATE KEY UPDATE parentID=parentID, name=name, seolink=seolink, primary_category_id=primary_category_id';
                            } elseif ($folder == 'filter') {
                                $sql_temp .= ' ON DUPLICATE KEY UPDATE categoryID=categoryID, name=name, type=type, item=item';
                            }

                            $result = mysqli_query($conn, $sql_temp);
                            if (false === $result) {
                                echo "<pre>Debug: $sql_temp</pre>\m";
                                printf("error: %s\n", mysqli_error($conn));
                            }

                        }
                    }
                    mysqli_close($conn);
                } else {
                    exit;
                }
                break;
        }


        $stop_time = microtime(true);

        $time = $stop_time - $start_time;
        $time = round($time, 2);
        if ($handle == null) {
            return [$dir[$i], $i + 1, $time, count($dir), 0];
        } else {
            return [$dir[$i], $i + 1, $time, count($dir), ftell($handle)];
        }

    }
}
