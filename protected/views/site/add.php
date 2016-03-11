<div class="row">
    <?php echo $form->labelEx($model,'attachments'); ?>
    <?php  $this->widget('CMultiFileUpload',
        array(
            'model'=>$model,
            'attribute' => 'attachments',
            'accept'=> 'jpg,jpeg,gif,png,doc,docx,xls,xlsx,pdf,txt,in4,rar,zip',
            'denied'=>'Разрешаем аттачить только форматы: jpg,jpeg,gif,png,doc,docx,xls,xlsx,pdf,txt,in4,rar,zip',
            'max'=>20,
            'remove'=>'[x]',
            'duplicate'=>'Вы уже прикрепили файл с таким именем. Давайте внимательней!',
        )
    );?>
    <?php echo $form->error($model,'attachments'); ?>
    <div class="hint">Не больше 20-х вложений.</div>
</div>