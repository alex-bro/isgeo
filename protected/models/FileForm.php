<?php
class FileForm extends CFormModel
{
    public $attachments;

    public function rules()
    {
        return array(
            array('attachments', 'file',
                'types' => 'jpg,jpeg,gif,png,doc,docx,pdf,txt',
                'maxSize' => 1024 * 1024 * 1, // 1MB
                'tooLarge' => 'The file was larger than 1MB. Please upload a smaller file.',
                'allowEmpty' => 1,
            ),
        );
    }
    public function attributeLabels()
    {
        return array(
            'attachments'=>'Вложения'
        );
    }
}