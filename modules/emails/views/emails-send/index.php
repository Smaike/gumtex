<?php
/* @var $this yii\web\View */
?>
<h1>Создать рассылку</h1>

<h3>Выберите шаблон</h3>
<input type="text" name="search_tpl" id="search_tpl" placeholder="Поиск по шаблонам" style="width:200px; margin-bottom:20px; "/><br/>
<select id="tpls" name="tpls" style="width:200px; margin-bottom:20px; ">
    <option>Выберите шаблон</option>
    <? foreach ($tpls as $v) { ?>
        <option value="<?=$v->id?>"><?=$v->name?></option>
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

<div id="example"></div>
<form id="newcontent">
    <input type="hidden" id="parent_id" name="parent_id" value="5" />
    <textarea id="newtpl"></textarea>
    <div class="row">
        <div class="col-md-4">
            <label for="email1" style="width:33%; float:left;">asd@asd.sd (Vasya) <input type="checkbox" id="email1" name="email[1]" /> </label>
            <label for="email1" style="width:33%; float:left;">asd@asd.sd (Vasya) <input type="checkbox" id="email1" name="email[1]" /> </label>
            <label for="email1" style="width:33%; float:left;">asd@asd.sd (Vasya) <input type="checkbox" id="email1" name="email[1]" /> </label>
            <label for="email1" style="width:33%; float:left;">asd@asd.sd (Vasya) <input type="checkbox" id="email1" name="email[1]" /> </label>
            <label for="email1" style="width:33%; float:left;">asd@asd.sd (Vasya) <input type="checkbox" id="email1" name="email[1]" /> </label>
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
                $('#example').html(resp.html);
                // $('#newtpl').html(resp.editor);
                 $('#newtpl').val(resp.html);
            }
         });
    })
    $('#send').click(function() {
        var data = $('#newcontent').serialize();
         $.ajax({
            type: 'POST',
           url: '/web/emails/emails-send/add',
            data: data,
            dataType: 'json'
         }).done(function (resp) {
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
?>
