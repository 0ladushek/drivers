<a href="/">На главную</a><br>

<h2>Баланс: <?= $this->driver->score; ?>руб</h2>

<h2>Добавить транзакцию</h2>
<form action="/transactions/add" method="post">
    <input type="hidden" name="driver_id" value="<?= $_GET['id'] ?>">
    <select name="type">
        <option value="1">Пополнить</option>
        <option value="0">Вывести</option>
    </select>
    <input type="number" name="summ" placeholder="Сумма" min="1" max="999999" required>
    <input type="submit" name="btn" value="Выполнить">
</form>

<h2>Список транзакций</h2>
<table>

    <?php if (!empty($this->transactions)): ?>
        <tr>
            <td>Операция</td>
            <td>Дата операций</td>
            <td>Сумма</td>
        </tr>
        <?php foreach ($this->transactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction->type ? 'Пополнение' : 'Вывод' ?> </td>
                <td><?= $transaction->date; ?> </td>
                <td><?= $transaction->value; ?> </td>
            </tr>
        <?php endforeach; ?>
        <?php else: echo 'У водителя отсуствуют транзакций.'; ?>
    <?php endif; ?>
</table>