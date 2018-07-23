/*
 *** JEM = jQuery Event Maneger *
 *
 * version 1.0.1   2016-11-26
 *    Commands 'block', 'inputMinus', 'inputРlus', 'scroll', 'unblock'
 *    and attribute [data-sload] was added
 * version 1.0.0   2016-11-19
 *    JEM library created
 *
 *
 *** Введение
 *
 * JEM предназначен для установки обработчиков простых действий в HTML разметке через атрибуты.
 * JEM основан на библиотеке jQuery и прост в использовании для тех, кто знаком с этой библиотекой.
 * JEM позиционируется как простая библиотека для простых действий, для сложных используйте AngularJS.
 * JEM не требует написания дополнительного JS кода, просто подключите и используйте.
 *
 *
 *** Использование
 *
 * Для использования JEM необходимо добавить элементу специальный атрибут, содержащий строку команд.
 * Шаблон: <тег атрибут="строка команд">
 *
 *
 *** Атрибуты для событий
 *
 * Событие 'change' - атрибут 'data-schange' - изменено поле ввода, переключатель или выпадающий список
 * Пример: <input type="text" data-schange="{'#selector':{'txt':'this'}}" />
 *
 * Событие 'click' - атрибут 'data-sclick' - клик левой клавишей мыши
 * Пример: <button data-sclick="{'#selector':{'class':'someclass'}}">Клик мыши(левая)</button>
 *
 * Событие 'focus' - атрибут 'data-sfocus' - выделено поле ввода, переключатель или выпадающий список
 * Пример: <input type="text" data-sfocus="{'#selector':{'txt':'this'}}" />
 *
 * Событие 'load' - атрибут 'data-sload' - страница загружена
 * Пример: <div class="modal" data-sload="{'this':{'show':true}}"></div>
 *
 * Событие 'mousedown' - атрибут 'data-smousedown' - левая клавиша мыши нажата
 * Пример: <button data-smousedown="{'#selector':{'class':'someclass'}}">Мышь(левая) нажата</button>
 *
 * Событие 'mouseup' - атрибут 'data-smouseup' - левая клавиша мыши отпущена
 * Пример: <button data-smouseup="{'#selector':{'class':'someclass'}}">Мышь(левая) отпущена</button>
 *
 *
 *** Строка команд - синтаксис и кавычки
 *
 * Синтаксис строки команд в целом подчиняется правилам формирования JSON строки.
 * Строка команд начинается символом { и заканчивается символом }
 * Команды разделяются символом ,
 * Имя команды следует брать в кавычки ' Имя команды от параметров отделяется символом :
 * Список команд берется в фигурные скобки { }
 * Селектор следует брать в кавычки ' Селектор от списка команд отделяется символом :
 *
 * Шаблон: <тег атрибут="{'команда1':'параметр1','команда2':'параметр2'}">Простая команда</тег>
 * Пример: <button data-sclick="{'href':'http://api.jquery.com/'}">Простая команда</button>
 *
 * Шаблон: <тег атрибут="{'селектор':{'команда1':'параметр1','команда2':'параметр2'}}">Команда с селектором</тег>
 * Пример: <button data-sclick="{'#selector':{'class':'someclass'}}">Команда с селектором</button>
 *
 * ВАЖНО! Внутри атрибута запрещено использовать двойные кавычки "
 * Для селекторов вместо двойныех кавычкек " используйте два апострофа `` ( клавиша ~ Ё )
 * Допускается использовать псевдоселекторы jQuery
 * Справка: http://api.jquery.com/category/selectors/jquery-selector-extensions/
 *
 * Пример: <button data-sclick="{'input[type=``radio``]':{'checked':false}}">Сбросить выбор</button>
 * Пример: <button data-sclick="{'input:radio':{'checked':false}}">Сбросить выбор</button>
 *
 *
 *** Простые команды
 *
 * 'block':true - блокирует экран, добавляя в <body> фиксированный полупрозрачный тёмный блок
 *
 * 'func путь.к.функции':[arguments] - Выполняет функцию, используя массив как аргументы функции
 * Пример:
 *    <button data-sclick="{'func objName.funcName':['arg1','arg2','arg3']}">Выполнить</button>
 *    Выполнить window['objName']['funcName'].apply(null,['arg1','arg2','arg3']);
 *    Примечание: аргумент 'event' будет заменен на объект события
 *
 * 'href':'url' - Переход по ссылке, параметр - строка URL
 * Пример:
 *    <button data-sclick="{'href':'http://api.jquery.com/'}">Переход по ссылке</button>
 *
 * 'prevent':true - Отмена действий по умолчанию
 * Пример:
 *    <button data-sclick="{'prevent':true}">Отмена действий по умолчанию</button>
 *
 * 'pushState':'url' - Изменение строки браузера, параметр - строка URL
 * Пример:
 *    <button data-sclick="{'pushState':'http://api.jquery.com/'}">Изменить строку браузера</button>
 *    Примечание: если браузер не поддерживает команду history.pushState, то действует как href
 *
 * 'scroll':'string' - Скролит страницу, параметр - число или строка.
 * Если передано число, то страница скролится к указанному числу.
 * Если передано 'bottom' страница скролится в самый низ
 * Если передано 'down' страница скролится на один экран вниз
 * Если передано 'top' страница скролится в самый верх
 * Если передано 'up' страница скролится на один экран вверх
 * Если передан селектор, то страница скролится к первому из найденных элементов
 * Пример:
 *    <button data-sclick="{'scroll':777}">Вниз на 777px</button>
 *    <button data-sclick="{'scroll':'top'}">Наверх</button>
 *    <button data-sclick="{'scroll':'#selector'}">К блоку с id="selector"</button>
 *
 * 'stop':true - Отмена  всплытия события
 * Пример:
 *    <button data-sclick="{'stop':true}">Отмена  всплытия события</button>
 *
 * 'unblock':true - убирает блокировку экрана, вызванную ранее командой 'block'
 *
 * 'validate':['regExp','errorText',{options}] - проверяет поле на соответствие регулярному выражению
 *    'regExp' - строка с регулярным выражением, специальные символы экранировать двумя \\
 *    'errorText' - сообщение ошибки, показываемое под полем ввода
 *    {options} - объект настроек, где по умолчанию:
 *      'classInvalid': 'invalid',    // класс невалидного поля
 *      'classValid': 'valid',        // класс валидного поля
 *      'helpBlockHTML': '<p class="help-block">{{errorText}}</p>',   // шаблон сообщения ошибки
 *      'showHelpBlock': false        // показывать ли сообщение ошибки
 * Пример:
 *    <input type="email" name="email" value="" data-schange="{ 'validate':['^\\w{1,33}@(\\w{1,15}\\.){1,3}\\w{1,6}$','Неверный формат E-mail'] }"/>
 *
 *
 *** Команды с селекторами
 *
 * 'attr' - Устанавливает атрибут, параметр - объект
 * Пример:
 *    <button data-sclick="{'#selector':{'attr':{'title':'sometitle'}}}">Устанавить атрибут</button>
 *
 * 'attrOff' - Устанавливает атрибут, параметр - объект, только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'attrOff':{'title':'sometitle'}}}" />
 *
 * 'attrRem' - Удаляет атрибут, параметр - строка
 * Пример:
 *    <button data-sclick="{'#selector':{'attrRem':'alt title'}}">Удаляет атрибут</button>
 *
 * 'attrRemOff' - Удаляет атрибут, параметр - строка, только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'attrRemOff':'alt title'}}" />
 *
 * 'checked' - Изменяет свойство 'checked', параметр - true или false
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'checked':true}}" />
 *    Примечание: свойство 'checked' целевых элементов устанавливается, если параметр совпадает с текущим
 *    состоянием управляющего элемента. Если у управляющего элемента нет свойств 'checked' или 'value',
 *    то свойство 'checked' целевых элементов бедет установлено, если параметр равен true.
 *
 * 'class' - Устанавливает класс, параметр - строка
 * Пример:
 *    <button data-sclick="{'#selector':{'class':'class1 class2'}}">Устанавить класс</button>
 *
 * 'classOff' - Устанавливает класс, параметр - строка, только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'class':'class1 class2'}}" /> *
 *
 * 'classRem' - Удаляет класс, параметр - строка
 * Пример:
 *    <button data-sclick="{'#selector':{'classRem':'someclass'}}">Удаляет класс</button>
 *
 * 'classRemOff' - Удаляет класс, параметр - строка, только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'classRemOff':'someclass'}}" />
 *
 * 'classToggle' - Переключает класс, параметр - строка
 * Пример:
 *    <button data-sclick="{'#selector':{'classToggle':'someclass'}}">Переключает класс</button>
 *
 * 'css' - Устанавливает стили, параметр - объект
 * Пример:
 *    <button data-sclick="{'#selector':{'css':{'height':'100px','width':'100px'}}}">Стили</button>
 *
 * 'cssOff' - Устанавливает стили, параметр - объект, только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'height':'100px','width':'100px'}}}" />
 *
 * 'disabled' - Изменяет свойство 'disabled', параметр - true или false
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'disabled':false}}" />
 *    Примечание: свойство 'disabled' целевых элементов устанавливается, если параметр совпадает с
 *    текущим состоянием управляющего элемента. Если у управляющего элемента нет свойств 'checked'
 *    или 'value',то свойство 'disabled' целевых элементов бедет установлено, если параметр равен true.
 *
 * 'each':'с.т.р.о.к.а' - Выполняет функцию для каждого целевого элемента
 * Пример:
 *    <button data-sclick="{'#selector':{'each':'funcName'}}">Выполнить</button>
 *    Выполнит  window['funcName'].call(index,element);
 * Пример:
 *    <button data-sclick="{'#selector':{'each':'objName.funcName'}}">Выполнить</button>
 *    Выполнит  window['objName']['funcName'].call(index,element);
 *
 * 'eachOff':'с.т.р.о.к.а' - Выполняет функцию для каждого целевого элемента, только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'eachOff':'funcName'}}" />
 *    Выполнит  window['funcName'].call(index,element);
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'eachOff':'objName.funcName'}}" />
 *    Выполнит  window['objName']['funcName'].call(index,element);
 *
 * 'hide' - Скрывает элементы, параметр - true или false
 * Пример:
 *    <button data-sclick="{'#selector':{'hide':true}}">Скрывает элементы</button>
 *    Примечание: выполняет elem.collapse('hide'); для элементов с классом 'collapse'
 *    Примечание: выполняет elem.modal('hide'); для элементов с классом 'modal'
 *    Примечание: выполняет elem.fadeOut(); для всех прочих элементов
 *
 * 'inputMinus' - Уменьшает свойство 'value' целевого элемента, параметр - число
 * Пример:
 *    <i class="fa fa-minus" data-sclick="{'#selector':{'inputMinus':1}}"></i>
 *    <input type="number" id="selector" value="7"/>
 *    Примечание: данный обработчик можно также установить, добавив класс .jem-input-minus
 *
 * 'inputРlus' - Увеличивает свойство 'value' целевого элемента, параметр - число
 * Пример:
 *    <input type="number" id="selector" value="7"/>
 *    <i class="fa fa-plus" data-sclick="{'#selector':{'inputРlus':1}}"></i>
 *    Примечание: данный обработчик можно также установить, добавив класс .jem-input-plus
 *
 * 'selected' - Изменяет свойство 'selected', параметр - true или false
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'selected':true}}" />
 *    Примечание: свойство 'selected' целевых элементов устанавливается, если параметр совпадает с
 *    текущим состоянием управляющего элемента. Если у управляющего элемента нет свойств 'checked'
 *    или 'value',то свойство 'selected' целевых элементов бедет установлено, если параметр равен true.
 *
 * 'show' - Показывает скрытые элементы, параметр - true или false
 * Пример:
 *    <button data-sclick="{'#selector':{'show':true}}">Показывает скрытые элементы</button>
 *    Примечание: выполняет elem.collapse('show'); для элементов с классом 'collapse'
 *    Примечание: выполняет elem.modal('show'); для элементов с классом 'modal'
 *    Примечание: выполняет elem.fadeIn(); для всех прочих элементов
 *
 * 'remove' - Удаляет элементы, параметр - true или false
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'remove':true}}" />
 *    Примечание: целевые элементы удаляются, если параметр совпадает с текущим состоянием
 *    управляющего элемента.
 *
 * 'trigger' - Имитирует событие, параметр - true или false
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'trigger':true}}" />
 *    Примечание: имитирует событие на целевых элементах, если параметр совпадает с текущим
 *    состоянием управляющего элемента.
 *
 * 'txt' - Записывает внутрь тега, параметр - строка или 'this'
 * Пример:
 *    <button data-sclick="{'#selector':{'txt':'Some text'}}">Записать</button>
 *    Примечание: если установлен параметр 'this', то в целевой элемент будет записан текст из
 *    свойства 'value' управляющего элемента
 *
 * 'txtOff' - Записывает внутрь тега, параметр - строка или 'this', только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'txtOff':'Some text'}}" />
 *    Примечание: если установлен параметр 'this', то в целевой элемент будет записан текст из
 *    свойства 'value' управляющего элемента
 *
 * 'value' - Изменяет свойство 'value', параметр - строка или 'this'
 * Пример:
 *    <button data-sclick="{'#selector':{'value':'Some text'}}">Записать</button>
 *    Примечание: если установлен параметр 'this', то в целевой элемент будет записан текст из
 *    свойства 'value' управляющего элемента
 *
 * 'valueOff' - Изменяет свойство 'value', параметр - строка или 'this', только для инпутов
 * Пример:
 *    <input type="chackbox" data-schange="{'#selector':{'valueOff':'Some text'}}" />
 *    Примечание: если установлен параметр 'this', то в целевой элемент будет записан текст из
 *    свойства 'value' управляющего элемента
 *
 *
 *** Селекторы
 *
 * В качестве селекторов могут выступать любые выражения, предусмотренные спецификацией CSS3.
 * ВАЖНО! Для селекторов вместо двойныех кавычкек " используйте два апострофа `` ( клавиша ~ Ё )
 * Допускается использовать псевдоселекторы jQuery
 * Справка: http://api.jquery.com/category/selectors/jquery-selector-extensions/
 *
 *
 *** Относительные селекторы
 *
 * 'closest селектор' - ближайший родитель, соответствующий селектору
 * Примечание: 'closest #selector' эквивалентно jQuery(e.target).closest('#selector');
 *
 * 'filter селектор' - текущий элемент, если он соответствует селектору
 * Примечание: 'filter #selector' эквивалентно jQuery(e.target).filter('#selector');
 *
 * 'find селектор' - дочерние элементы, соответствующие селектору
 * Примечание: 'find #selector' эквивалентно jQuery(e.target).find('#selector');
 *
 * 'has селектор' - текущий элемент, если у него есть дети, соответствующие селектору
 * Примечание: 'has #selector' эквивалентно jQuery(e.target).has('#selector');
 *
 * 'nextAll селектор' - правые соседи, соответствующие селектору
 * Примечание: 'nextAll #selector' эквивалентно jQuery(e.target).nextAll('#selector');
 *
 * 'notThis селектор' - элементы, соответствующие селектору, кроме текущего
 * Примечание: 'notThis #selector' эквивалентно jQuery('#selector').not(e.target));
 *
 * 'prevAll селектор' - левые соседи, соответствующие селектору
 * Примечание: 'prevAll #selector' эквивалентно jQuery(e.target).prevAll('#selector');
 *
 * 'siblings селектор' - все соседи, соответствующие селектору
 * Примечание: 'siblings #selector' эквивалентно jQuery(e.target).siblings('#selector');
 *
 * 'this селектор' - элементы, соответствующие селектору, и текущий элемент
 * Примечание: 'this #selector' эквивалентно jQuery('#selector').add(e.target));
 *
 *
 *** Установка обработчиков через классы
 *
 * 'jem-input-minus' - Уменьшает свойство 'value' ближайшего элемента <input type="number">
 * 'jem-input-plus' - Увеличивает свойство 'value' ближайшего элемента <input type="number"> *
 * Пример:
 *    <div>
 *      <i class="fa fa-minus jem-input-minus"></i>
 *      <input type="number" value="7"/>
 *      <i class="fa fa-plus jem-input-plus"></i>
 *    </div>
 *    Примечание: данные обработчики можно также установить с помощью атрибутов
 *
 * 'jem-scroll-bottom' - Скролит страницу в самый низ
 * 'jem-scroll-down' - Скролит страницу на один экран вниз
 * 'jem-scroll-top' - Скролит страницу в самый верх
 * 'jem-scroll-up' - Скролит страницу на один экран вверх
 * Пример:
 *    <span class="glyphicon glyphicon-upload jem-scroll-top"></span>
 *    <span class="glyphicon glyphicon-download jem-scroll-down"></span>
 *
 *
 *** От автора
 *
 * Пока JEM находится в опытной эксплуатации, документация будет только на русском языке.
 * Завершённая библиотека будет переведена на английский язык.
 * Если Вы переведёте документацию на свой язык, это улучшит Вам карму :)
 *
 * JEM полностью свободен, используйте на здоровье.
 *
 * Всем, дочитавшим до сюда, желаю счастья. Да благословят Вас Господь, Будда и Аллах.
 */

var $jem = new Object;

jQuery(function () {
  /* Event handlers */
  jQuery('body').on('change', '[data-schange]', function (e) {
    $jem.getActions(e, 'data-schange');
  });
  jQuery('body').on('click', '[data-sclick]', function (e) {
    $jem.getActions(e, 'data-sclick');
  });
  jQuery('body').on('focus', '[data-sfocus]', function (e) {
    $jem.getActions(e, 'data-sfocus');
  });
  jQuery(window).on('load', function (e) {
    jQuery('[data-sload]').each(function () {
      e.currentTarget = e.target = this;
      $jem.getActions(e, 'data-sload');
    });
  });
  jQuery('body').on('mousedown', '[data-smousedown]', function (e) {
    $jem.getActions(e, 'data-smousedown');
  });
  jQuery('body').on('mouseup', '[data-smouseup]', function (e) {
    $jem.getActions(e, 'data-smouseup');
  });

  /* Input increment and decrement */
  jQuery('body').on('mousedown', '.jem-input-minus', function (e) {
    var targetInput = $(e.target).parent().find('input:not(:radio,:checkbox)');
    $jem.selectorActions.inputMinus(targetInput);
  });
  jQuery('body').on('mousedown', '.jem-input-plus', function (e) {
    var targetInput = $(e.target).parent().find('input:not(:radio,:checkbox)');
    $jem.selectorActions.inputРlus(targetInput);
  });
  jQuery('body').on('selectstart', '.jem-input-minus,.jem-input-plus', function () {
    return false;
  });

  /* Scroll */
  jQuery('body').on('click', '.jem-scroll-bottom', function () {
    $jem.func.scrollTo('bottom');
  });
  jQuery('body').on('click', '.jem-scroll-down', function () {
    $jem.func.scrollTo('down');
  });
  jQuery('body').on('click', '.jem-scroll-top', function () {
    $jem.func.scrollTo('top');
  });
  jQuery('body').on('click', '.jem-scroll-up', function () {
    $jem.func.scrollTo('up');
  });
});

/* перебор вариантов в цикле, получает событие и объект команд, запускает обработчики команд */
$jem.change = function (e, actions) {
  var checkable = e.target.type === 'radio' || e.target.type === 'checkbox';
  var checked = checkable ? e.target.checked : null;
  var value = e.target.value || '';
  var isOn = checked || (!checkable && value > '');
  var isOff = checked === false || (!checkable && !value > '');
  for (var i in actions) {
    if (typeof (actions[i]) !== 'object' || typeof (actions[i].length) !== 'undefined') {
      $jem.simpleActions(i, actions[i], e);
      continue;
    }
    var elements = $jem.getElements(i, e);
    if (elements.length < 1) {
      continue;
    }
    for (var j in actions[i]) {
      var param = actions[i][j];
      var isSet = (checkable && !(checked ^ param)) || (!checkable && !(value > '' ^ param));
      if ((j === 'attr' && isOn) || (j === 'attrOff' && isOff)) {
        $jem.selectorActions.arrt(elements, param);
      } else
      if ((j === 'attrRem' && isOn) || (j === 'attrRemOff' && isOff)) {
        $jem.selectorActions.attrRem(elements, param);
      } else
      if (j === 'checked') {
        $jem.selectorActions.checked(elements, isSet);
      } else
      if ((j === 'class' && isOn) || (j === 'classOff' && isOff)) {
        $jem.selectorActions.class(elements, param);
      } else
      if ((j === 'classRem' && isOn) || (j === 'classRemOff' && isOff)) {
        $jem.selectorActions.classRem(elements, param);
      } else
      if (j === 'classToggle') {
        $jem.selectorActions.classToggle(elements, param);
      } else
      if ((j === 'css' && isOn) || (j === 'cssOff' && isOff)) {
        $jem.selectorActions.css(elements, param);
      } else
      if (j === 'disabled') {
        $jem.selectorActions.disabled(elements, isSet);
      } else
      if ((j === 'each' && isOn) || (j === 'eachOff' && isOff)) {
        $jem.selectorActions.each(elements, param);
      } else
      if (j === 'hide' && isSet) {
        $jem.selectorActions.hide(elements);
      } else
      if (j === 'selected') {
        $jem.selectorActions.selected(elements, isSet);
      } else
      if (j === 'show' && isSet) {
        $jem.selectorActions.show(elements);
      } else
      if (j === 'remove' && isSet) {
        $jem.selectorActions.remove(elements);
      } else
      if (j === 'trigger') {
        $jem.selectorActions.trigger(elements, param);
      } else
      if ((j === 'txt' && isOn) || (j === 'txtOff' && isOff)) {
        $jem.selectorActions.txt(elements, param, value);
      } else
      if ((j === 'value' && isOn) || (j === 'valueOff' && isOff)) {
        $jem.selectorActions.value(elements, param, value);
      }
    }
  }
  if (actions.prevent) {
    return false;
  }
};

/* перебор вариантов в цикле, получает событие и объект команд, запускает обработчики команд */
$jem.click = function (e, actions) {
  var value = e.target.value || '';
  for (var i in actions) {
    if (typeof (actions[i]) !== 'object' || typeof (actions[i].length) !== 'undefined') {
      $jem.simpleActions(i, actions[i], e);
      continue;
    }
    var elements = $jem.getElements(i, e);
    if (elements.length < 1) {
      continue;
    }
    for (var j in actions[i]) {
      var param = actions[i][j];
      if (j === 'attr') {
        $jem.selectorActions.arrt(elements, param);
      } else
      if (j === 'attrRem') {
        $jem.selectorActions.attrRem(elements, param);
      } else
      if (j === 'checked') {
        $jem.selectorActions.checked(elements, param);
      } else
      if (j === 'class') {
        $jem.selectorActions.class(elements, param);
      } else
      if (j === 'classRem') {
        $jem.selectorActions.classRem(elements, param);
      } else
      if (j === 'classToggle') {
        $jem.selectorActions.classToggle(elements, param);
      } else
      if (j === 'css') {
        $jem.selectorActions.css(elements, param);
      } else
      if (j === 'disabled') {
        $jem.selectorActions.disabled(elements, param);
      } else
      if (j === 'each') {
        $jem.selectorActions.each(elements, param);
      } else
      if (j === 'hide') {
        $jem.selectorActions.hide(elements);
      } else
      if (j === 'inputMinus') {
        $jem.selectorActions.inputMinus(elements, param);
      } else
      if (j === 'inputРlus') {
        $jem.selectorActions.inputРlus(elements, param);
      } else
      if (j === 'selected') {
        $jem.selectorActions.selected(elements, param);
      } else
      if (j === 'show') {
        $jem.selectorActions.show(elements);
      } else
      if (j === 'remove') {
        $jem.selectorActions.remove(elements);
      } else
      if (j === 'trigger') {
        $jem.selectorActions.trigger(elements, param);
      } else
      if (j === 'txt') {
        $jem.selectorActions.txt(elements, param, value);
      } else
      if (j === 'value') {
        $jem.selectorActions.value(elements, param, value);
      }
    }
  }
  if (actions.prevent) {
    return false;
  }
};

/* объект, содержит настройки и константы */
$jem.config = {
  'classInvalid': 'invalid',
  'classValid': 'valid',
  'helpBlockHTML': '<p class="help-block">{{errorText}}</p>',
  'showHelpBlock': false
};

/* объект, содержит обработчики простых команд и вспомогательные функции */
$jem.func = {
  'block': function () {
    jQuery('body').append('<div class="modal-backdrop in" style="background-color:#000;bottom:0px;cursor:progress;height:100%;left:0px;opacity:0;position:fixed;right:0px;top:0px;z-index:1040;"></div>').fadeTo('400', '0.5');
  },
  'apply': function (i, param, e) {
    var fPath = i.replace(/^func./, '');
    var func = $jem.getVar(fPath);
    if (typeof (func) !== 'function') {
      return;
    }
    if (typeof (param) === 'object' && typeof (param.length) === 'number') {
      for(var i in param){
        if(param[i] === 'event'){
          param[i] = e || {'currentTarget': $jem.current};
        }
      }
      func.apply(null, param);
    }
  },
  'scrollSpy': function () {
    var doc = document.documentElement;
    if (window.pageYOffset < (doc.scrollHeight - doc.clientHeight)) {
      $('.jem-scroll-bottom, .jem-scroll-down').fadeIn();
    } else {
      $('.jem-scroll-bottom, .jem-scroll-down').fadeOut();
    }
    if (window.pageYOffset > 0) {
      $('.jem-scroll-top, .jem-scroll-up').fadeIn();
    } else {
      $('.jem-scroll-top, .jem-scroll-up').fadeOut();
    }
  },
  'scrollTo': function (param) {
    var destination;
    if (typeof (param) === 'number' || /^\d+$/i.test(param)) {
      destination = param * 1;
    } else if (param === 'bottom') {
      destination = document.documentElement.scrollHeight;
    } else if (param === 'down') {
      destination = window.pageYOffset + document.documentElement.clientHeight * 0.95;
    } else if (param === 'top') {
      destination = 0;
    } else if (param === 'up') {
      destination = window.pageYOffset - document.documentElement.clientHeight * 0.95;
    } else {
      var wpadminbar = $('#wpadminbar').height() || 0;
      destination = $(param).offset().top - parseInt(wpadminbar);
    }
    $('html, body').animate({scrollTop: destination}, 1000);
  },
  'unblock': function () {
    jQuery('body > div.modal-backdrop').fadeTo('200', '0', function () {
      jQuery(this).remove();
    });
  },
  'validate': function (param, e) {
    var input = jQuery(e.currentTarget).filter('input,select,textarea');
    if (input.length !== 1){
      return;
    }
    var regexp = new RegExp(param[0],'i');
    var errorText = param[1];
    var opt = jQuery.extend({
      'classInvalid': $jem.config.classInvalid,
      'classValid': $jem.config.classValid,
      'helpBlockHTML': $jem.config.helpBlockHTML,
      'showHelpBlock': $jem.config.showHelpBlock,
      'submit': ''
    }, param[2] || {});
    var form = input.closest('.jem-form, form');
    var button = form.find('.jem-submit, [type="submit"]').add(opt.submit);
    if (regexp.test(input.val())) {
      input.removeClass(opt.classInvalid).addClass(opt.classValid);
      if (!jQuery('input,select,textarea', form).is('.' + opt.classInvalid)) {
        form.removeClass(opt.classInvalid).addClass(opt.classValid);
        button.removeAttr('disabled').prop('disabled', false);
      }
      if (opt.showHelpBlock) {
        input.nextAll('.help-block').remove();
      }
    } else {
      input.add(form).removeClass(opt.classValid).addClass(opt.classInvalid);
      button.attr('disabled', 'disabled').prop('disabled', true);
      if (opt.showHelpBlock && errorText) {
        input.parent().append(opt.helpBlockHTML.replace(/{{errorText}}/, errorText));
      }
    }
  }
};

/* перебор вариантов, получает событие и имя атрибута, парсит строку команд, запускает циклы */
$jem.getActions = function (e, attr) {
  if (e.currentTarget.disabled) {
    return;
  }
  $jem.current = e.currentTarget;
  var actions = JSON.parse($jem.current.getAttribute(attr).replace(/\\\'/g, '&#39;').replace(/'/g, '"'));
  if (!actions || typeof (actions) !== 'object') {
    return;
  }
  switch (attr) {
    case 'data-schange':
    case 'data-sfocus':
      $jem.change(e, actions);
      break;
    case 'data-sclick':
    case 'data-sload':
    case 'data-smousedown':
    case 'data-smouseup':
      $jem.click(e, actions);
      break;
  }
};

/* перебор вариантов, принимает строку селекторов, возвращает коллекцию jQuery */
$jem.getElements = function (i) {
  var elements, ii = i.trim().replace(/``/g, '"');
  if (/^closest/.test(ii)) {
    elements = jQuery($jem.current).closest(ii.replace(/^closest./, ''));
  } else if (/^filter/.test(ii)) {
    elements = jQuery($jem.current).filter(ii.replace(/^filter./, ''));
  } else if (/^find/.test(ii)) {
    elements = jQuery($jem.current).find(ii.replace(/^find./, ''));
  } else if (/^has/.test(ii)) {
    elements = jQuery($jem.current).has(ii.replace(/^has./, ''));
  } else if (/^nextAll/.test(ii)) {
    elements = jQuery($jem.current).nextAll(ii.replace(/^nextAll./, ''));
  } else if (/^notThis/.test(ii)) {
    elements = jQuery(ii.replace(/^notThis./, '').not($jem.current));
  } else if (/^prevAll/.test(ii)) {
    elements = jQuery($jem.current).prevAll(ii.replace(/^prevAll./, ''));
  } else if (/^siblings/.test(ii)) {
    elements = jQuery($jem.current).siblings(ii.replace(/^siblings./, ''));
  } else if (/^this/.test(ii)) {
    elements = jQuery(ii.replace(/^this./, '')).add($jem.current);
  } else {
    elements = jQuery(ii);
  }
  return elements;
};

/* функция, примимает строку - путь к переменной, возвращает переменную */
$jem.getVar = function (path) {
  var pathArr = path.trim().split('.');
  var currentVar = window, k = 0;
  while (pathArr[k]) {
    currentVar = currentVar[pathArr[k++].trim()];
    if (!currentVar) {
      return false;
    }
  }
  return currentVar;
};

/* объект, содержит обработчики команд с селекторами */
$jem.selectorActions = {
  'attr': function (elements, param) {
    elements.arrt(param);
  },
  'attrRem': function (elements, param) {
    elements.removeAttr(param);
  },
  'checked': function (elements, isSet) {
    if (isSet) {
      elements.attr('checked', 'checked').prop('checked', true);
    } else {
      elements.removeAttr('checked').prop('checked', false);
    }
  },
  'class': function (elements, param) {
    elements.addClass(param);
  },
  'classRem': function (elements, param) {
    elements.removeClass(param);
  },
  'classToggle': function (elements, param) {
    elements.toggleClass(param);
  },
  'css': function (elements, param) {
    elements.css(param);
  },
  'disabled': function (elements, isSet) {
    if (isSet) {
      elements.attr('disabled', 'disabled').prop('disabled', true);
    } else {
      elements.removeAttr('disabled').prop('disabled', false);
    }
  },
  'each': function (elements, param) {
    var func = $jem.getVar(param);
    if (typeof (func) === 'function') {
      elements.each(function (ind, item) {
        func.call(ind, item);
      });
    }
  },
  'hide': function (elements) {
    elements.each(function () {
      var elem = jQuery(this);
      if (elem.is('.collapse')) {
        if (elem.is('.in, .collapsing')) {
          elem.collapse('hide');
        }
      } else if (elem.hasClass('modal')) {
        elem.modal('hide');
      } else {
        elem.hide();
      }
    });
  },
  'inputMinus': function (elements, param) {
    param = param * 1 || 1;
    var limit = elements.attr('min') || 0;
    elements.val(Math.max(limit, elements.val() * 1 - param)).change();
  },
  'inputРlus': function (elements, param) {
    param = param * 1 || 1;
    var limit = elements.attr('max') || 999;
    elements.val(Math.min(limit, elements.val() * 1 + param)).change();
  },
  'selected': function (elements, isSet) {
    if (isSet) {
      elements.parent('select').find('option').removeAttr('selected').prop('selected', false);
      elements.attr('selected', 'selected').prop('selected', true);
    } else {
      elements.removeAttr('selected').prop('selected', false);
    }
  },
  'show': function (elements) {
    elements.each(function () {
      var elem = jQuery(this).removeClass('hide');
      if (elem.is('.collapse')) {
        if (!elem.is('.in, .collapsing')) {
          elem.collapse('hide');
        }
        elem.collapse('show');
      } else if (elem.hasClass('modal')) {
        elem.modal('show');
      } else {
        elem.show();
      }
    });
  },
  'remove': function (elements) {
    elements.remove();
  },
  'trigger': function (elements, param) {
    elements.trigger(param);
  },
  'txt': function (elements, param, value) {
    elements.html(param === 'this' ? value : param);
  },
  'value': function (elements, param, value) {
    elements.val(param === 'this' ? value : param);
  }
};

/* перебор вариантов, принимает имя команды, параметр и событие, запускает обработчик команды */
$jem.simpleActions = function (i, param, e) {
  if (i === 'block') {
    $jem.func.block();
  } else
  if (/^func/.test(i)) {
    $jem.func.apply(i, param, e);
  } else
  if (i === 'href') {
    location.href = param;
  } else
  if (i === 'prevent') {
    e.preventDefault();
  } else
  if (i === 'pushState') {
    $jem.url.pushState(param);
  } else
  if (i === 'scroll') {
    $jem.func.scrollTo(param);
  } else
  if (i === 'stop') {
    e.stopPropagation();
  } else
  if (i === 'unblock') {
    $jem.func.unblock();
  } else
  if (i === 'validate') {
    $jem.func.validate(param, e);
  }
};

/* объект, содержит методы работы со строкой браузера */
$jem.url = {
  'GET': function () {
    var get = this.parseSearch(location.search.substr(1));
    get.hash = location.hash;
    return get;
  },
  'parseSearch': function (search) {
    if (search) {
      var searchObj = JSON.parse('{"' + search.replace(/"/g, '\\"').replace(/&/g, '","').replace(/\\=/g, '&#61;').replace(/=/g, '":"') + '"}');
      for (var i in searchObj) {
        if (/[^\\]\+/.test(searchObj[i])) {
          searchObj[i] = searchObj[i].trim().replace(/\\\+/g, '&#43;').split('+');
        }
      }
      return searchObj;
    } else {
      return new Object;
    }
  },
  'pushState': function (newUrl) {
    if (history.pushState) {
      history.pushState({}, '', newUrl);
      return true;
    } else {
      location.href = newUrl;
    }
  },
  'remove': function (url, name) {
    var newUrl = url || location.href;
    var regexp = new RegExp('(\\?|&)' + name + '=[\\w\\-]+?(&|$)', 'i');
    newUrl = newUrl.replace(regexp, function (s0, s1, s2) {
      return (s2 === '&') ? s1 : '';
    });
    return newUrl;
  },
  'replace': function (url, name_val) {
    var newUrl = url || location.href;
    for (var name in name_val) {
      newUrl = this.remove(name, newUrl);
      if (!name_val[name]) {
        continue;
      }
      if (/\?/.test(newUrl)) {
        newUrl += '&' + name + '=' + name_val[name];
      } else {
        newUrl += '?' + name + '=' + name_val[name];
      }
    }
    return newUrl;
  }
};

$jem.config.helpBlockHTML = '<span class="float-label-down help-block" style="opacity: 1;transform: matrix(1, 0, 0, 1, 0, 18);">{{errorText}}</span>';
$jem.config.showHelpBlock = true;