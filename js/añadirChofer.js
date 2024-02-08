document.addEventListener('DOMContentLoaded', function () {

   const dialog = document.getElementById('dialog');
   const openDialog = document.getElementById('openDialog');
   const cancelBtn = document.getElementById('cancelBtn');
   const opacidad = document.querySelector('.barra-navegacion')

   openDialog.addEventListener('click', (e) => {
      e.preventDefault();
      opacidad.style.filter = "blur(2px)";
      dialog.showModal();   
   });



   cancelBtn.addEventListener('click', (e) => {
      e.preventDefault();
      opacidad.style.filter = "none";
      dialog.close();
   });

   document.addEventListener('keydown', (event) => {
      var keyValue = event.key;
      console.log("keyValue: " + keyValue);

      if (keyValue === "Escape") {
         dialog.close();
         opacidad.style.filter = "none";
      }

    }, false);
});