<?require_once 'header.php'?>
    <main class="admin-pan">
        <div class="container">
            <div class="admin-pan__inner">
                <div class="admin-pan__section">
                    <h2 class="admin-pan__title">Заказы</h2>
                    <form class="admin-pan__toolbar">
                        <div class="admin-pan__tool">
                            <label for="new">Новые</label>
                            <input type="checkbox" name="new" id="new" name="new" checked>
                        </div>
                        <div class="admin-pan__tool">
                            <label for="accepted">Подтвержденные</label>
                            <input type="checkbox" name="accepted" id="accepted" name="accepted">
                        </div>
                        <div class="admin-pan__tool">
                            <label for="canceled">Отмененные</label>
                            <input type="checkbox" name="canceled" id="canceled" name="canceled">
                        </div>
                        <button class="catalog-toolbar__btn admin-pan__btn" name="admin_refresh">Обновить</button>
                    </form>
                    <table class="admin-pan__orders">
                        <thead>
                            <tr>
                                <td>Фото</td>
                                <td>Название</td>
                                <td>Заказчик</td>
                                <td>Количество</td>
                                <td>Время</td>
                                <td>Действия</td>
                            </tr>
                        </thead>
                        <tr class="admin-pan__order">
                            <td>
                                <div class="admin-pan-order__media">
                                <img src="media/images/6b8ff4aa5dbb588a6060bdd0aa681d06.jpeg" alt="" class="admin-pan-order__pict">
                                </div>
                            </td>
                            <td>
                                <div class="admin-pan-order__name">Инструмент</div>
                            </td>
                            <td>
                                <div class="admin-pan-order__client">Иванов Иван Иванович</div>
                            </td>
                            <td>
                                <div class="admin-pan-order__count">1</div>
                            </td>
                            <td>
                                <div class="admin-pan-order__time"></div>
                            </td>
                            <td>
                                <div class="admin-pan-order__actions">
                                    <a href="?accept=" class="admin-pan-order__action admin-pan-order__action_accept">Подтвердить</a>
                                        <form class="admin-pan-order__cancel-action" action="" method="get">
                                            <input type="hidden" name="id_order" value="1">
                                            <textarea name="message" class="admin-pan-order__message"></textarea>
                                            <button type="submit" class="admin-pan-order__action admin-pan-order__action_cancel">Отменить</button>
                                        </form>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script></script>
    <?require_once 'js/script.php'?>
    <?require_once 'js/admin_script.php'?>
</body>
</html>