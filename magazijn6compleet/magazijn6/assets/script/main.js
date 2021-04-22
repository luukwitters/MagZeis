/**
 * Function to open the delete modal
 *
 * @param repairId the id of the repair
 */
function openModal(repairId) {
    // Getting the modal and the modal content
    let deleteModal = document.getElementById("deleteRepair");
    let deleteModalContent = document.getElementById("deleteRepairContent");
    // Getting the content title
    let deleteModalTitle = document.getElementById("modalTitle");

    // Setting the repair id in the modal title
    deleteModalTitle.innerText = "Verwijder reparatie " + repairId;

    // Setting the repairId in the modal
    document.getElementById("repairId").value = repairId;

    // Opening the modal
    deleteModal.classList.add("modal--visible");
    deleteModalContent.classList.add("modal__content-show");
}

/**
 * Function to close the open modal
 */
function closeModal() {
    // Getting the modal and the modal content
    let deleteModal = document.getElementById("deleteRepair");
    let deleteModalContent = document.getElementById("deleteRepairContent");

    // Removing the classes that make the modal visible
    deleteModal.classList.remove("modal--visible");
    deleteModalContent.classList.remove("modal__content-show");
}