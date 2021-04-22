<div class="modal" id="deleteRepair" tabindex="-1" role="alertdialog">
    <div class="modal__content" id="deleteRepairContent">
        <div class="modal__header">
            <h5 class="modal__title" id="modalTitle">Verwijder reparatie</h5>
            <button type="button" class="modal__close" onclick="closeModal()">
                <span>&times;</span>
            </button>
        </div>

        <div class="modal__body">
            <p class="modal__text">Weet je zeker dat je deze reparatie wilt verwijderen? </p>
        </div>

        <div class="modal__footer">
            <button type="submit" class="modal__cancel" onclick="closeModal()">Terug</button>
            <form method="post" class="modal__form">
                <input type="hidden" name="txtRepairId" id="repairId">
                <button type="submit" name="btnDeleteRepair" class="modal__submit">Verwijder reparatie</button>
            </form>
        </div>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 17:29
 */

// Checking if the user pressed the delete repair button
if (isset($_POST['btnDeleteRepair'])) {
    // Sending the id to the controller
    $repairCtrl->delete($_POST['txtRepairId']);
}
?>