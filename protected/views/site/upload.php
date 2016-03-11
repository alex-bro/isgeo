<div class="form">
    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div class="flash-success" style="
    padding: 10px;
    border: 1px solid green;
    width: 98%;
    text-align: center;
    color: green;">
            <?php echo Yii::app()->user->getFlash('success');?>
        </div>
    <?php endif; ?>
    <h3>Загрузите xml файл</h3>
    <?php $this->renderPartial('_upload'); ?>
</div>
