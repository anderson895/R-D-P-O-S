document.addEventListener('DOMContentLoaded', () => {
  // Add Unit Modal
  const unitNameInput = document.getElementById('unit_name');
  const unitDescriptionInput = document.getElementById('unit_description');
  const confirmButton = document.querySelector('.toglerAddUnit');
  const validationMessages = document.getElementById('validation-messages');

  function toggleConfirmButton() {
    const unitName = unitNameInput.value.trim();
    const unitDescription = unitDescriptionInput.value.trim();
    const isUnitNameValid = unitName.length >= 1 && unitName.length <= 20; // Added condition for length between 1 and 5
   
    if (!isUnitNameValid) {
        validationMessages.textContent = 'Unit Name should have a minimum of 1 and a maximum of 20 characters';
    } else {
        validationMessages.textContent = ''; // Clear any previous messages
    }

    confirmButton.disabled = !(isUnitNameValid);
}


  unitNameInput.addEventListener('input', toggleConfirmButton);
  unitDescriptionInput.addEventListener('input', toggleConfirmButton);

  // Edit Unit Modal
  const unitNameInputUpdate = document.getElementById('unit_name_update');
  const unitDescriptionInputUpdate = document.getElementById('unit_description_update');
  const confirmButtonUpdate = document.querySelector('.toglerEditUnitProcess');
  const validationMessagesUpdate = document.getElementById('validation-messages_for_updateModal');

  function toggleUpdateButton() {
    const unitNameUpdate = unitNameInputUpdate.value.trim();
    const unitDescriptionUpdate = unitDescriptionInputUpdate.value.trim();
    const isUnitNameValidUpdate = unitNameUpdate.length >= 1 && unitNameUpdate.length <= 20; // Added condition for length between 1 and 5
   

    if (!isUnitNameValidUpdate) {
        validationMessagesUpdate.textContent = 'Unit Name should have a minimum of 1 and a maximum of 20 characters';
    }  else {
        validationMessagesUpdate.textContent = ''; 
    }

    confirmButtonUpdate.disabled = !(isUnitNameValidUpdate);
}


  unitNameInputUpdate.addEventListener('input', toggleUpdateButton);
  unitDescriptionInputUpdate.addEventListener('input', toggleUpdateButton);
});
