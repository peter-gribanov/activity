$(function(){
	if (typeof tinymce != 'undefined') {
		tinymce.init({
			selector: '.tinymce-note',
			language_url: '/tinymce_languages_ru.js',
			plugins: [
				"advlist autolink lists link",
				"searchreplace",
				"contextmenu paste"
			],
			toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
		});
		tinymce.init({
			selector: '.tinymce-program',
			language_url: '/tinymce_languages_ru.js',
			plugins: [
				"advlist autolink link",
				"searchreplace",
				"table contextmenu paste"
			],
			toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
		});
	}
});