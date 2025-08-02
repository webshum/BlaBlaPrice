var folder;

jQuery(document).ready(function () {

    jQuery('#category').on("click", function () {
        folder = 'category';
        csv();
    });

    jQuery('#product').on("click", function () {
        folder = 'product';
        csv();
    });

    jQuery('#filter').on("click", function () {
        folder = 'filter';
        csv();
    });

    jQuery('#price').on("click", function () {
        folder = 'price';
        csv();
    });
});

function roundToTwo(num) {
    return +(Math.round(num + "e+2") + "e-2");
}

function csv() {
    var $i = 0;
    var $line = 0;
    var callback = function (response) {
        if (response && typeof response == "string") {
            response = JSON.parse(response);
            progress(response.dir, response.time, roundToTwo((response.i / response.counter * 100)) + '%', '.' + folder + '-tab');
            if (response.i) {
                $i = response.i;
                $line = response.line;
                loadCsn($i, folder, $line, callback);
            }
        } else {
            alert('done!');
        }
    }
    loadCsn($i, folder, $line, callback);
}

function loadCsn($i, $folder, line, callback) {
    jQuery.ajax({
        url: '/admin/site/load-csv',
        method: 'POST',
        data: {
            i: $i,
            folder: $folder,
            line: line,
        }
    }).done(function (data) {
        if (callback) callback(data);
    });
}

function progress(file, time, prec, tab) {
    jQuery(tab).find('.progress-bar').css('width', prec);
    jQuery(tab).find('.progress-bar').html(prec);
    jQuery(tab).find('.file-row').each(function (indx, element) {
        if (jQuery(element).children('.file').html() == file) {
            jQuery(element).children('.status').html(time + " sec.");
        }
    })
}