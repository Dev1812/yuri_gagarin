<?php
class View {
    /**
     * @desc 
     * @param <String> content_view - Шаблон для каждой страницы
     * @param <String> template_view - Главный Шаблон
     * @param <Array> param - Настройки для страницы
     * @param <Array> data - Содержит информацю(записи из Базы Данных, новости)
     * @param <Array> i18n - Локализация на сайте
     *
     */
  public function generate($content_view, $template_view = 'template_view.php', $param, $data = null, $i18n = null) {
    include 'application/views/'.$template_view;  
  }

}
