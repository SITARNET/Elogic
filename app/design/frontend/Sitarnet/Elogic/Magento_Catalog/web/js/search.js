define([
    "jquery"
], function ($) {
    'use strict';

    $.widget('mage.searchscript', {

        _create : function () { // метод
            $('#filter').keyup(function () { // срабатывает, когда клавиша была отпущена в срабатывает в input с id="filter"
                var value = $(this).val().toLowerCase(); // возвращает или устанавливает значение атрибута value + переводит значение в нижний регистр
                if (value.length > 2) { // условие: если длина строки больше 2
                    console.log('String has: ' + value.length); // .length - представляет длину строки
                    $('.products.list.items li').filter(function () { // перебераем все li в class="products list items"
                        let result = $(this).find('a.product-item-link').text().toLowerCase().indexOf(value) > -1; // let - объявляет переменную с
                        // блочной областью видимости с возможностью инициализировать её значением. +
                        // .find - получиние потомков каждого элемента в текущем наборе совпадающих элементов,
                        // отфильтрованных с помощью селектора, объекта jQuery или элемента. +
                        // .text - получает текст выбранного элемента в наборе. Если таких элементов несколько,
                        // получит содержимое всех элементов, разделенные пробелом. +
                        // .toLowerCase() - переводит значение в нижний регистр. +
                        // .indexOf - возвращает индекс первого вхождения указанного значения в строковый объект String,
                        // на котором он был вызван, начиная с индекса fromIndex. Возвращает -1, если значение не найдено.
                        $(this).toggle(result); // позволяет отобразить или скрыть выбранные элементы. Если элемент изначально отображается,
                        // то он будет скрыт, если элемент скрыт, то он будет отображен.
                    });
                } else { // в другом случаии
                    console.log('String has less than tree symbols: ' + value.length); // .length - представляет длину строки
                }
                if (value.length <= 2) { // условие: если длина строки меньше или равно 2
                    console.log('String has: ' + value.length);
                    $('.products.list.items li').filter(function () {
                        let result = $(this).find('a.product-item-link').text().toLowerCase().indexOf(value) > -1;
                        $(this).toggle(result); // отображаем все выбранные элементы
                    });
                }
            });
        }
    });
    return $.mage.searchscript;
});
