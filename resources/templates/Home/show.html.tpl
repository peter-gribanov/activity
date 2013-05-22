<?
/**
 * @param array   $event
 * @param booelan $is_admin
 * @param booelan $is_login
 * @param array   $comments
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-event-card">
<h2><?=$event['name']?></h2>
<p><strong>Дата</strong> <?=self::rudateinterval($event['date_start'], $event['date_end'])?></p>
<p><strong>Организатор</strong> <?=$event['company']?></p>
<?if($event['price']):?>
	<p><strong>Цена</strong> <?=$event['price']?>
<?endif?>
<p><strong>Место проведения</strong> <?=$event['venue']?></p>
<?if($event['offer']):?>
	<p><strong>Что предлагают</strong> <?=$event['offer']?></p>
<?endif?>
<?if($event['used']):?>
	<p><strong>Чем воспользовались и представитель</strong> <?=$event['used']?></p>
<?endif?>
<?if($is_admin && $event['note']):?>
	<p><strong>Пометки</strong></p>
	<div><?=$event['note']?></div>
<?endif?>
<?if($event['program']):?>
	<p><strong>Программа</strong></p>
	<div><?=$event['program']?></div>
<?endif?>
</div>
<?if($comments):?>
<div class="b-comments">
	<?foreach($comments as $comment):?>
		<section>
			<header><?=self::rudate($comment['time'])?> <?=date('H:i', $comment['time'])?> <?=$comment['name']?> (<?=$comment['department']?>)</header>
			<article><?=$comment['comment']?></article>
		</section>
	<?endforeach?>
</div>
<?else:?>
Нет комментариев<br>
<?endif?>
<?if($is_login):?>
	<div class="b-add-comment">
		<form event="" method="post">
			<textarea rows="5" cols="60" name="comment"></textarea><br />
			<button type="submit">Отправить</button>
		</form>
	</div>
<?else:?>
	Вам необходимо авторизоваться для того чтобы добавить комментарий<br>
<?endif;?>