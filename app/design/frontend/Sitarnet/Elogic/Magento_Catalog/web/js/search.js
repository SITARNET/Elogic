define([
    "jquery"
], function ($) {
    'use strict';

    $.widget('mage.searchscript', {

        _create: function () { // метод
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

                /**
                 * 1) У тебе уже є ця умова вище - else!
                 * if (value.length > 2) - тут говориться, що якщо значення строго більше 2, тобто в else
                 * попадає 2 і все що менше менше 2-ох, тобі не потрібно прописувати тут другий раз умову, просто перенеси це в
                 * else вище.
                 *
                 * Видали цю умову
                 */
                if (value.length <= 2) { // условие: если длина строки меньше или равно 2
                    console.log('String has: ' + value.length);

                    /**
                     * 2) Тут ти робиш лишні дії, тобі просто потрібно показати всі без виключення, а не шукати які ти
                     * сховав і показувати:
                     * $('.products.list.items li').show(); - було би достатньо
                     *
                     * $('.products.list.items li') - цей вираз тобі вертає цілу колекцію лішок і jquery дозволяє
                     * тобі не проходитися циклом по кожній окремо взятій лішці, а зразу задіяти один метод до цілої
                     * колекції.
                     */
                    // $('.products.list.items li').filter(function () {
                        // let result = $(this).find('a.product-item-link').text().toLowerCase().indexOf(value) > -1;
                        // $(this).toggle(result);
                    // });
                }
            });

        },

        /**
         * Що тут робить ця анонімна функція? Вона нічого не робить, просто оголошена. І це ж віджет!
         * Ну і навіщо ти дублюєш код? Ти уже підписаний на цю подію вище
         *
         * Що потрібно зробити:
         * 1. Видали цю анонімну функцію;
         * 2. Код з методами removeHighlight() і highlight(searchTerm) перенеси у метод _create()
         * 3. Рекомендую винести $('.products.list.items.product-items').removeHighlight(); в окремий метод віджета
         * типу - removeHighlight: function() { $('.products.list.items.product-items').removeHighlight(); }
         *
         * Я перевірив, ця ліба працює добре, вона огортає слова в спан і додає клас highlight - я добавив підсвітку
         * на цей клас, якщо ти все зробиш вірно - слова будуть виділені жовтим кольором
         */
        function() {
            $('#filter').bind("keyup", function (ev) {
                // pull in the new value
                var searchTerm = $(this).val();

                // remove any old highlighted terms
                $('.products.list.items.product-items').removeHighlight();

                // disable highlighting if empty
                if (searchTerm) {
                    // highlight the new term
                    $('.products.list.items.product-items').highlight(searchTerm);
                }
            });
        }
    });

    return $.mage.searchscript;
});
