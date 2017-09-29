
<table>
    <h2>Добавить водителя</h2>
    <form action="/drivers/add" method="post">
        <input type="text" name="name" placeholder="Имя водителя" required>
        <input type="text" name="car" placeholder="Машина" required>
        <input type="submit" value="Добавить">
    </form>

    <h2>Водители</h2>
    <tr>
        <td>Имя</td>
        <td>Машина</td>
        <td>Дата регистраций</td>
        <td>Баланс</td>
    </tr>

    <?php foreach ($this->drivers as $driver): ?>
        <tr>
            <td><?= $driver->name; ?> </td>
            <td><?= $driver->car; ?> </td>
            <td><?= $driver->reg_date; ?> </td>
            <td><?= $driver->score; ?> </td>
            <td><a href="/transactions/default/?id=<?= $driver->id ?>">Транзакций</a></td>
            <td><a href="/drivers/delete/?id=<?= $driver->id ?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
</table>
