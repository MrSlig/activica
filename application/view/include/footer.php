<div class="footer">
        <br/>
            <div>
                <h5>ЗАГРУЗКА НОВОГО ФАЙЛА:</h5>
                <form enctype="multipart/form-data" method="post" action="index.php?action=parser">
                    <p>
                        <input type="file" name="XML">
                        <input type="submit" value="Отправить">
                    </p>
                </form>
            </div>            <div>
                <h5>СБРОС ТАБЛИЦЫ ДАННЫХ:</h5>
                <form method="post" action="index.php?action=erase">
                    <p>
                        <input type="submit" value="СБРОСИТЬ!">
                    </p>
                </form>
            </div>
    </div>
</body>
</html>