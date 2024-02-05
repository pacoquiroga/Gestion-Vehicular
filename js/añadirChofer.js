document.addEventListener('DOMContentLoaded', function () {

    const dialog = document.getElementById('dialog');
    const openDialog = document.getElementById('openDialog');
    const cancelBtn = document.getElementById('cancelBtn');
 ;
 
    openDialog.addEventListener('click', (e) => {
       e.preventDefault();
       dialog.showModal();
    });
 
    cancelBtn.addEventListener('click', (e) => {
       e.preventDefault();
       dialog.close();
   });
 
 });