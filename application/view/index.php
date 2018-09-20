<?php
/**  @var $data[] \Activica\YMLParser\Offer\Offer */
?>

<style>
    #filter-table{
        width: 100%;
    }
    #filter-table th{
        background-color: #dadada;
    }
    #filter-table td, #filter-table th{
        padding: 5px;
        border-bottom: 1px solid #ccc;
    }
</style>

<table id="filter-table">
    <thead>
    <tr>
        <th>Производитель</th>
        <th>Категория</th>
        <th>Есть в наличии</th>
        <th>Название</th>
        <th>Модель</th>
        <th>Описание</th>
        <th>Изображение</th>
        <th>Цвет</th>
        <th>Ссылка</th>
        <th>Цена</th>
        <th>Цена(опт)</th>
        <th>Артикуль</th>
        <th>Новинка</th>
    </tr>
    <tr class='table-filters'>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
        <td><input type="text"/></td>
    </tr>
    </thead>
    <!-- А вот на этот элемент нам нужно получить ссылку для передачи в filterTable //-->
    <tr class='table-data'>
        <td>B</td><td>Арбуз</td><td>2</td><td>3</td><td>Фанат</td>
    </tr>
    <tr class='table-data'>
        <td>B</td><td>Стрелок</td><td>1</td><td>2</td><td>Арба</td>
    </tr>
    <tr class='table-data'>
        <td>C</td><td>Фанат</td><td>3</td><td>1</td><td>Стрелок</td>
    </tr>
    <tr class='table-data'>
        <td>C</td><td>Стрелок</td><td>2</td><td>1</td><td>Фантомас</td>
    </tr>
    <tr class='table-data'>
        <td>B</td><td>Стрелок</td><td>1</td><td>2</td><td>Арбуз</td>
    </tr>
    <tr class='table-data'>
        <td>C</td><td>Фанат</td><td>3</td><td>3</td><td>Стрелок</td>
    </tr>
    <tr class='table-data'>
        <td>A</td><td>Арбуз</td><td>2</td><td>2</td><td>Арбуз</td>
    </tr>
    <tr class='table-data'>
        <td>A</td><td>Фанат</td><td>1</td><td>1</td><td>Стрелочник</td>
    </tr>
    <tr class='table-data'>
        <td>C</td><td>Фанат</td><td>3</td><td>3</td><td>Арбуз</td>
    </tr>
    <tr>
        <td>B</td><td>Фанат</td><td>2</td><td>3</td><td>Фантик</td>
    </tr>
    <tr class='table-data'>
        <td>C</td><td>Стрелок</td><td>1</td><td>1</td><td>Арбуз</td>
    </tr>
    <tr class='table-data'>
        <td>C</td><td>Фанат</td><td>3</td><td>2</td><td>Стрелка</td>
    </tr>
</table>

<?php if ($data[0]): ?>
    <div>
        <h1 id="title_post"><?php echo $data[1]->getName() ?></h1>
        <p><?php echo $data[1]->getDescription() ?></p>
    </div>
<?php else: ?>
    <div>
        <h1 id="title_post">404 ошибка</h1>
    </div>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
    <script>
    $('.table-filters input').on('input', function () {
        filterTable($(this).parents('table'));
    });

    function filterTable($table) {
        var $filters = $table.find('.table-filters td');
        var $rows = $table.find('.table-data');
        $rows.each(function (rowIndex) {
            var valid = true;
            $(this).find('td').each(function (colIndex) {
                if ($filters.eq(colIndex).find('input').val()) {
                    if ($(this).html().toLowerCase().indexOf(
                        $filters.eq(colIndex).find('input').val().toLowerCase()) == -1) {
                        valid = valid && false;
                    }
                }
            });
            if (valid === true) {
                $(this).css('display', '');
            } else {
                $(this).css('display', 'none');
            }
        });
    }
</script>

<!--
<script>
    var titlePost = document.getElementById('title_post');
    var newTitle = '';
    for (var i = titlePost.innerHTML.length - 1; i >= 0; i--) {
        newTitle = newTitle + titlePost[i];
    }
    titlePost.innerHTML = newTitle;
</script>
-->