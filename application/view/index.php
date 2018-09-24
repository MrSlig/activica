<?php
/**  @var $offer \Activica\YMLParser\Offer\Offer */
/**  @var $data[] */
?>

<!-- temporary stylesheet-->
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

<?php if ($data): ?>

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
        <th>Цена (опт)</th>
        <th>Артикул</th>
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
    <?php foreach ($data as $offer): ?>
        <tr class='table-data'>
            <td><?php echo $offer->getVendor() ?></td>
            <td><?php echo $offer->getCategoryId() ?></td>
            <td><?php echo $offer->isAvailable() ?></td>
            <td><?php echo $offer->getName() ?></td>
            <td><?php echo $offer->getModel() ?></td>
            <td><?php echo $offer->getDescription() ?></td>
            <td>
                <?php foreach ($offer->getPictures() as $picture): ?>
                    <?php echo $picture ?>
                <?php endforeach; ?>
            </td>
            <td><?php echo $offer->getSeason() ?></td>
            <td><?php echo $offer->getUrl() ?></td>
            <td><?php echo $offer->getPrice() ?></td>
            <td><?php echo $offer->getOptPrice() ?></td>
            <td><?php echo $offer->getArticul() ?></td>
            <td><?php echo $offer->isNew() ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php else: ?>
    <div>
        <h3 id="title_post">Пожалуйста, загрузите XML-файл для отображения каталога.</h3>
    </div>
<?php endif; ?>

<script>
    <?php include JS_PATH . 'tableFilter.js';?>
</script>