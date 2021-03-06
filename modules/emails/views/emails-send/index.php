<?php
/* @var $this yii\web\View */
?>
<? if (empty($users)) {
    echo 'В таблицу users нет записей' ;
    return;
}
?>
<h1>Создать рассылку</h1>

<h3>Выберите шаблон</h3>
<? /*<input type="text" name="search_tpl" id="search_tpl" placeholder="Поиск по шаблонам" style="width:200px; margin-bottom:20px; "/><br/> */ ?>
<select id="tpls" name="tpls" class="selectpicker" data-live-search="true">
    <option value="">Выберите шаблон</option>
    <? foreach ($tpls as $v) { ?>
        <option  data-tokens="ketchup mustard" value="<?=$v->id?>"><?=$v->name?></option>
    <? } ?>
</select>

<? /*<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Шаблоны <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</div>*/ ?>

<? /*<div id="example" style="margin-top:20px;"></div> */ ?>


<form id="newcontent" style="margin-top:30px;">
    <input type="hidden" id="parent_id" name="parent_id" value="5" />

    <div class="form-group">

    <label>Редактирование шаблона</label>
        <div style="border:1px solid #000;">
            <?php skeeks\widget\ckeditor\CKEditorInline::begin(['preset' => skeeks\yii2\ckeditor\CKEditorPresets::BASIC]);?>

            <?php skeeks\widget\ckeditor\CKEditorInline::end();?>
        </div>
    <textarea id="newtpl" name="newtpl" style="display:none"></textarea>
    </div>
    <div class="form-group">
    <label>Тема письма</label><br/>
    <input type="text" name="subject" id="subject" value="" />
    </div>

    <label><br/>Выберите письма для отправки</label>
    <div class="row">
        <div class="col-md-8">
            <div class="row" style="margin-top:10px; margin-bottom:10px;">
                <? foreach ($users as $user) { ?>
                    <div class="col-xs-4">
                        <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" class="emailcheck" name="emails[]" id="email<?= $user->id ?>" value="<?= $user->id ?>">
                        </span>
                            <label class="input-group-addon" for="email<?= $user->id ?>"><?=$user->last_name?> <?=$user->first_name?><br/><?=$user->email?></label>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <button id="send">Отправить</button>
    <div id="success"></div>
</form>
<?
$script = <<< JS
    var field = $('#tpls').find('option');

    $('#search_tpl').bind('keyup', function() {
        var q = new RegExp($(this).val(), 'ig');

        for (var i = 0, l = field.length; i < l; i += 1) {
            var option = $(field[i]),
                parent = option.parent();

            if ($(field[i]).text().match(q)) {
                if (parent.is('span')) {
                    option.show();
                    parent.replaceWith(option);
                }
            } else {
                if (option.is('option') && (!parent.is('span'))) {
                    option.wrap('<span>').hide();
                }
            }
            $('#tpls').click();
        }
    });
    
    $('#tpls').change(function() {
        var newid = $(this).val();
       
        //TODO добавить проверку на внесенные изменения
        //и потом гетом получить все
         $.ajax({
            type: 'POST',
            url: '/web/emails/emails-send/select',
            data: {newid: newid},
            dataType: 'json'
         }).done(function (resp) {
             console.log(resp);
            if (!resp.status) {
                alert(resp.msg)
            } else {
                $('#parent_id').val(newid);
                //$('#example').html(resp.html);
                // $('#newtpl').html(resp.editor);
                 $('#newtpl').val(resp.html);
                 $('#w0').html(resp.html);
                 $('#subject').val(resp.subj);
            }
         });
    });
    $('#send').click(function() {
        if (!$('.emailcheck:checked').length) {
            alert('выберите хоть один email');
            return false;
        }
        $('#newtpl').val($('#w0 p').html());
        
        
     
       if ($('#newtpl').val()=='' || $('#newtpl').val()=='<br>') { //костылина(
               alert('заполните шаблон');
               return false;
           }
           
       
        if ($('#tpls').val()=='') {
           alert('Выберите шаблон');
           return false;
        } if ($('#subject').val()=='') {
           alert('Тема письма пустая');
           return false;
        }
        var data = $('#newcontent').serialize();
         $.ajax({
            type: 'POST',
           url: '/web/emails/emails-send/add',
            data: data,
            dataType: 'json'
         }).done(function (resp) {
             console.log(resp);
             return false;
            if (!resp.status) {
                alert(resp.msg)
            } else {
               $('#success').html('Рассылка создана');
            }
         });
         return false;
    })
JS;
$this->registerJs($script, yii\web\View::POS_READY);
$this->registerJsFile('/web/js/bootstrap-select.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerCssFile('/web/css/bootstrap-select.min.css', ['position' => \yii\web\View::POS_END]);
?>

