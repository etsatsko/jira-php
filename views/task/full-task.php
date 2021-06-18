<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Описание задачи "' . $task->title . '"';
$this->params['breadcrumbs'][] = $this->title;
?>
<div onload="load_page()">
    <a href="/task/update-task/<?=$task->id?>"><button type="button" class="btn btn-primary">Обновить задачу</button></a>
</div>
<script>
    function load_page() {
        if (<?=deadlined?>) {
            alert("Задача просрочена");
        }
        if (<?=time_limited?>){
            alert("Слишком много времени потрачено на задачу");
        }
    }
</script>
<p>Задача: <?=Html::encode($task->title)?></p>
<p>Тип задачи: <?=Html::encode($type->name)?></p>
<p>Описание: <?=Html::encode($task->description)?></p>
<p>Автор: <?=Html::encode($author->login)?></p>
<p>Исполнитель: <?=Html::encode($executor->login)?></p>
<p>Статус: <?=Html::encode($status->name)?></p>
<p>Дата создания: <?=Html::encode($task->create_date)?></p>
<p>Класс: <?=Html::encode($serviceClass->name)?></p>
<p>Выполнить до: <?=Html::encode($task->deadline)?></p>
<p>Максимальные трудозатраты: <?=Html::encode($task->time_estimate)?></p>

    <textarea id="comment" type="text" placeholder="Comment"></textarea>
    <script>
        function add_comment() {
            var id = <?=$task->id?>;
            var text = document.getElementById("comment").value;

            var url = "/task/add-comment/" + id + "/" + text;

            $http({
                method: 'POST',
                url: url,
                success: function(data)
                {
                    alert(data);
                }
            });
            // window.location.replace("/task/add-comment/" + id + "/" + text);
        }
    </script>
    <button class="btn btn-primary" onclick="add_comment()">Добавить комментарий</button>
    </br>

    <textarea id="work_time" type="number" placeholder="Time"></textarea>
    <textarea id="workcost" type="text" placeholder="Comment"></textarea>
    <script>
        function add_work_cost() {
            var id = <?=$task->id?>;
            var text = document.getElementById("workcost").value;
            var time = document.getElementById("work_time").value;

            var url = "/task/add-work-cost/" + id + "/" + time +"/" + text;
            
            $http({
                method: 'POST',
                url: url,
                success: function(data)
                {
                    alert(data);
                }
            });
            // window.location.replace("/task/add-work-cost/" + id + "/" + time +"/" + text);
        }
    </script>
    <button class="btn btn-primary" onclick="add_work_cost()">Добавить трудозатраты</button>
    </br>
<div>
    <a href="/task/delete-task/<?=$task->id?>"><button type="button" class="btn btn-primary">Удалить задачу</button></a>
</div>
<p style="font-weight: 700">Комментарии к задаче</p>
<?php foreach ($comments as $comment) { ?>
    <div class="flex-container">
        <p><?=$users[Yii::$app->formatter->asInteger($comment->author_id) - 1]->login?></p>
        <p><?=$comment->text?></p>
        <p><?=$comment->create_date?></p>
    </div>
<?php } ?>
<p style="font-weight: 700">Трудозатраты</p>
<?php foreach ($work_costs as $work_cost) { ?>
    <div class="flex-container">
        <p><?=$users[Yii::$app->formatter->asInteger($work_cost->author_id) - 1]->login?></p>
        <p><?=$work_cost->time?></p>
        <p><?=$work_cost->comment?></p>
        <p><?=$work_cost->create_date?></p>
    </div>
<?php } ?>
