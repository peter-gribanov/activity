<?
/**
 * @param array   $action
 * @param booelan $is_login
 * @param array   $comments
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-action-card">
<h2><?=$action['name']?></h2>
<p><strong>Дата</strong> <?=self::rudateinterval($action['date_start'], $action['date_end'])?></p>
<p><strong>Организатор</strong> <?=$action['company']?></p>
<p><strong>Цена</strong> <?if($action['price']):?><?=$action['price']?> руб.<?else:?>бесплатно<?endif;?></p>
<p><strong>Место проведения</strong> <?=$action['venue']?></p>
<?if($action['offer']):?>
	<p><strong>Что предлагают</strong> <?=$action['offer']?></p>
<?endif?>
<?if($action['used']):?>
	<p><strong>Чем воспользовались и представитель</strong> <?=$action['used']?></p>
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
		<form action="" method="post">
			<textarea rows="5" cols="60" name="comment"></textarea><br />
			<button type="submit">Отправить</button>
		</form>
	</div>
<?else:?>
	Вам необходимо авторизоваться для того чтобы добавить комментарий<br>
<?endif;?>