<?php

require('../../contrib/simpleAjaxUploader/Uploader.php');

$upload_dir = '../../Resources/Public/Images/';
$valid_extensions = array('gif', 'png', 'jpeg', 'jpg');

$Upload = new FileUpload('uploadfile');
$result = $Upload->handleUpload($upload_dir, $valid_extensions);

if (!$result) {
    echo json_encode(array('success' => false, 'msg' => $Upload->getErrorMsg()));
} else {
    //echo json_encode(array('success' => true, 'file' => $Upload->getFileName()));

    print "<script>top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('../typo3conf/ext/mminteractive/Resources/Public/Images/" . $Upload->getFileName() . "').closest('.mce-window').find('.mce-primary').click();</script>";
    //return HttpResponse("<script>alert('%s');</script>" % escapejs('\n'.join([v[0] for k, v in form.errors.items()])))

}