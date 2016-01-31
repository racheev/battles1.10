$(document).ready(function() {

			var button = $('#uploadButton1'), interval;

			$.ajax_upload(button, {
						action : '/components/battles/upload.php',
						name : 'myfile',
						onSubmit : function(file1, ext) {
							// показываем картинку загрузки файла
							$("img#load").attr("src", "/components/battles/img/load.gif");
							$("#uploadButton font").text('Загрузка');

							/*
							 * Выключаем кнопку на время загрузки файла
							 */
							this.disable();

						},
						onComplete : function(file1, response) {
							// убираем картинку загрузки файла
							$("img#load").attr("src", "/components/battles/img/loadstop.gif");
							$("#uploadButton font").text('Загрузить');
							
							// снова включаем кнопку
							//this.enable();

							// показываем что файл загружен
							$("<div><font color=\"green\"><b>" + file1 + "</b></font></div><img src=\"/images/battles/" + file1 + "\" width=\"150\" height=\"150\"><input type=\"hidden\" name=\"files1\" value=" + file1 + ">").appendTo("#files1");

						}
					});
		});
		
$(document).ready(function() {

			var button = $('#uploadButton2'), interval;

			$.ajax_upload(button, {
						action : '/components/battles/upload.php',
						name : 'myfile',
						onSubmit : function(file2, ext) {
							// показываем картинку загрузки файла
							$("img#load").attr("src", "/components/battles/img/load.gif");
							$("#uploadButton font").text('Загрузка');

							/*
							 * Выключаем кнопку на время загрузки файла
							 */
							this.disable();

						},
						onComplete : function(file2, response) {
							// убираем картинку загрузки файла
							$("img#load").attr("src", "/components/battles/img/loadstop.gif");
							$("#uploadButton font").text('Загрузить');
							
							// снова включаем кнопку
							//this.enable();

							// показываем что файл загружен
							$("<div><font color=\"green\"><b>" + file2 + "</b></font></div><img src=\"/images/battles/" + file2 + "\" width=\"150\" height=\"150\"><input type=\"hidden\" name=\"files2\" value=" + file2 + ">").appendTo("#files2");

						}
					});
		});
		
		
$(document).ready(function() {

			var button = $('#uploadButton3'), interval;

			$.ajax_upload(button, {
						action : '/components/battles/upload.php',
						name : 'myfile',
						onSubmit : function(file3, ext) {
							// показываем картинку загрузки файла
							$("img#load").attr("src", "/components/battles/img/load.gif");
							$("#uploadButton font").text('Загрузка');

							/*
							 * Выключаем кнопку на время загрузки файла
							 */
							this.disable();

						},
						onComplete : function(file3, response) {
							// убираем картинку загрузки файла
							$("img#load").attr("src", "/components/battles/img/loadstop.gif");
							$("#uploadButton font").text('Загрузить');
							
							// снова включаем кнопку
							//this.enable();

							// показываем что файл загружен
							$("<div><font color=\"green\"><b>" + file3 + "</b></font></div><img src=\"/images/battles/" + file3 + "\" width=\"150\" height=\"150\"><input type=\"hidden\" name=\"files3\" value=" + file3 + ">").appendTo("#files3");

						}
					});
		});