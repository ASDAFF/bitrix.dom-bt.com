<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("smt_show_sidebar_banner", "Y");
$APPLICATION->SetTitle("О компании");
?><h2><i>Строительная компания "Европейский Дом"</i></h2>
<h3 class="smt-header smt-header-underline-left"> <i>Строить с нами легко!</i> </h3>
<p>
	 Главное направление нашей компании — строительство каркасных домов и домов из бруса в Санкт-Петербурге и Ленинградской области. Мы занимаемся этим уже 12 лет. Мы накопили гигантский опыт, и сегодня мы воплощаем только самые проверенные решения в области конструктива, технологии и эргономики строительства.
</p>
<p>
	 Мы всегда воплощали идею пассивного дома, где шли по пути снижения эксплуатационных расходов наших домов. Нашим домам не требуется дорогостоящая система отопления, многие наши заказчики выбирали электрические конвекторы, потому что с нашими технологиями подвод газа становится экономически нецелесообразным.
</p>
<p>
	 Летом, что приятно, дом сохранит прохладу внутри, уменьшив потребление электричества.
</p>
<p>
	 Мы построим такой дом и для Вас!
</p>
<h2 class="smt-header smt-header-underline-center">Вам понравится с нами работать!<br>
 На это есть много причин:</h2>
<div class="row">
	<div class="smt-widget-content__main col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="smt-history-list">
			<div class="smt-history-item" id="bx_3218110189_389">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Опыт
					</div>
					<div class="smt-history-item__descr">
						<div>
							 Наша компания занимается профессиональным строительством каркасных и брусовых домов <b>более 11 лет</b>, поэтому предлагаем нашим заказчикам только проверенные технологии, примененные на многих объектах
						</div>
						<p>
						</p>
					</div>
				</div>
			</div>
			<div class="smt-history-item" id="bx_3218110189_388">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Технологии
					</div>
					<div class="smt-history-item__descr">
						<div>
							 Мы используем самые <b>современные материалы</b>, которые отбираются по самым строгим санитарным и противопожарным требованиям
						</div>
						<p>
						</p>
					</div>
				</div>
			</div>
			<div class="smt-history-item" id="bx_3218110189_387">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Собственное производство
					</div>
					<div class="smt-history-item__descr">
						<div>
							 Большая часть конструкций собирается в заводских условиях с применением <b>современного оборудования</b>
						</div>
						<p>
						</p>
					</div>
				</div>
			</div>
			<div class="smt-history-item" id="bx_3218110189_386">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Отношение к заказчику
					</div>
					<div class="smt-history-item__descr">
						<div>
							 Каждый объект мы <b>строим, как для себя</b>, внимательно учитывая все пожелания заказчика.
						</div>
					</div>
				</div>
			</div>
			<div class="smt-history-item" id="bx_3218110189_385">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Технический надзор
					</div>
					<div class="smt-history-item__descr">
						<div>
							 Каждый этап строительства будет контролироваться <b>техническим директором</b>, что исключает возможность строительных ошибок
						</div>
						<p>
						</p>
					</div>
				</div>
			</div>
			<div class="smt-history-item" id="bx_3218110189_384">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Воплощаем мечты
					</div>
					<div class="smt-history-item__descr">
						<div>
							 Гибкость наших строительных технологий позволяют браться за <b>самые смелые и оригинальные проекты</b>
						</div>
						<p>
						</p>
					</div>
				</div>
			</div>
			<div class="smt-history-item" id="bx_3218110189_907">
				<div class="smt-history-item__content">
					<div class="smt-history-item__name h2 smt-header">
						 Отсутствие скрытых платежей
					</div>
					<div class="smt-history-item__descr">
						 Часто строители нагружают своих заказчиков неожиданными работами, которые "возникают в процессе строительства", в результате чего происходит значительное удорожание возведения дома. В нашем случае, <b>стоимость всех работ прописывается в договоре</b> и является окончательной.
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix">
		</div>
	</div>
</div>
 <br>
<div class="special-block center">
	<h2 class="smt-header smt-header-underline-center">Сделайте шаг навстречу своей мечте прямо сейчас!</h2>
Заполните форму, мы свяжемся с Вами, ответим на все Ваши вопросы и бесплатно проконсультируем по всем этапам строительства
</div>
 <?$APPLICATION->IncludeComponent(
	"simpletemplates:form.order", 
	".default", 
	array(
		"AJAX_URL" => "/smt_ajax/ajax_form.php",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CUSTOM_FORM_SUBMIT" => "Отправить заявку",
		"CUSTOM_TITLE_100" => "Ваш телефон:",
		"CUSTOM_TITLE_101" => "Ваш email:",
		"CUSTOM_TITLE_102" => "",
		"CUSTOM_TITLE_103" => "",
		"CUSTOM_TITLE_201" => "",
		"CUSTOM_TITLE_202" => "",
		"CUSTOM_TITLE_203" => "",
		"CUSTOM_TITLE_204" => "",
		"CUSTOM_TITLE_205" => "",
		"CUSTOM_TITLE_206" => "",
		"CUSTOM_TITLE_207" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Сообщение:",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Ваше имя:",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"DISPLAY_ICON" => "Y",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"EMAIL_TO" => "koxbox@gmail.com",
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"FIELDS_ORDER" => "NAME,100,101,DETAIL_TEXT,102",
		"FORMS_DISABLE_AGREEMENT" => "N",
		"FORM_SUFFIX" => "contactpageform",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "smt_form",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "100",
			1 => "101",
			2 => "102",
			3 => "103",
			4 => "NAME",
			5 => "DETAIL_TEXT",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "100",
			1 => "102",
			2 => "NAME",
		),
		"REDIRECT_URL" => "",
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"SHOW_FORM_BORDER" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "Ваше сообщение успешно отправлено",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>