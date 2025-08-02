<?php
namespace common\components\behaviors;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

/**
 * Class ImageBehavior
 * @package common\components\behaviors
 *
 * @property string thumbUrl
 * @property string imageUrl
 * @property mixed galleryImage
 *
 *
 */
class ImageBehavior extends \yii\base\Behavior
{

    public $path = '';
    public $url = '';
    public $attribute;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete'
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave()
    {
        $file = UploadedFile::getInstances($this->owner, $this->attribute);

        if (!empty($file)) {
            foreach ($file as $file_item) {

                $filename = uniqid();
                preg_match('(\.\w+)', $file_item->name, $extension);

                $file_item->saveAs(Yii::getAlias('@app') . '/web/uploads/' . $filename . $extension[0]);
                
                if (is_array($this->owner->{$this->attribute})) {
                    $temp[] = $filename . $extension[0];
                } else {
                    $temp = $filename . $extension[0];
                }
                
                $this->make_thumb(Yii::getAlias('@app') . '/web/uploads/' . $filename . $extension[0],
                    Yii::getAlias('@app') . '/web/uploads/thumb/thumb_' . $filename . $extension[0], 200);

            }

            $this->owner->{$this->attribute} = $temp;
        } else {
            $this->owner->{$this->attribute} = $this->owner->getOldAttribute($this->attribute);
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeUpdate()
    {
        $this->deleteFile();
        $this->beforeSave();
    }


    /**
     * Make thumbnail of uploaded images
     *
     * @param $src string
     * @param $dest string
     * @param $desired_width integer
     */
    public function make_thumb($src, $dest, $desired_width)
    {

        /* read the source image */
        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest);
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        $this->deleteFile();
        return true;
    }

    /**
     *Delete image from files
     */
    public function deleteFile()
    {
        if (is_file(Yii::getAlias('@app') . '/web/uploads/' . $this->owner->getOldAttribute($this->attribute))) {
            unlink(Yii::getAlias('@app') . '/web/uploads/' . $this->owner->getOldAttribute($this->attribute));
        }
    }

    /**
     * Return Image source
     *
     * @return string
     */
    public function getImageUrl()
    {
        return Yii::getAlias('@app') . '/uploads/' . $this->owner->{$this->attribute};
    }

    /**
     * Return array of images
     *
     * @return mixed
     */
    public function getGalleryImage()
    {
        if ($this->owner->{$this->attribute}) {
            //foreach ($this->owner->{$this->attribute} as $image) {
            $result[$this->owner->{$this->attribute}->ID] = Yii::getAlias('@app') . '/uploads/' . $this->owner->{$this->attribute}->image;
            //}
        } else {
            $result = Yii::getAlias('@app') . '/uploads/no-image.png';
        }

        return $result;
    }

    /**
     * Return thumbnail of image
     *
     * @return string
     */
    public function getThumbUrl()
    {
        if ($this->owner->{$this->attribute} == '') {
            return $this->url . '/img/icon-47.png';
        } else {
            return Yii::getAlias('@app') . '/uploads/thumb/thumb_' . $this->owner->{$this->attribute};
        }
    }
}
