  
window.addEventListener('swal:modal', event => { 
    swal.fire({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
    });
});
  
window.addEventListener('swal:confirm', event => { 
    swal.fire({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
      showCancelButton: true,
      confirmButtonText: event.detail.confirmButtonText,
      cancelButtonText:  event.detail.cancelButtonText,
      reverseButtons: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',

    })
    .then((result) => {        
      if (result.isConfirmed) {
        window.livewire.emit(event.detail.action);
      }
    });
});


window.addEventListener('swal:confirmApplication', event => { 
    swal.fire({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
      showCancelButton: true,
      confirmButtonText: event.detail.confirmButtonText,
      cancelButtonText:  event.detail.cancelButtonText,
      reverseButtons: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((result) => {
       
      if (result.isConfirmed) {  
        window.livewire.emit(event.detail.action);
      }
    });
});


window.addEventListener('swal:destroyMultiple', function(event){
  swal.fire({
     title:event.detail.message,
     text: event.detail.text,
     icon:event.detail.type,
     showCloseButton:true,
     showCancelButton:true,
     confirmButtonText: event.detail.confirmButtonText,
     cancelButtonText:  event.detail.cancelButtonText,
     reverseButtons: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
 }).then(function(result){
     if(result.value){
        window.livewire.emit(event.detail.action);
     }
 });
});


window.addEventListener('swal:joinPromotion', function(event){
  swal.fire({
     title:event.detail.message,
     text: event.detail.text,
     icon:event.detail.type,
     showCloseButton:true,
     showCancelButton:true,
     confirmButtonText: event.detail.confirmButtonText,
     cancelButtonText:  event.detail.cancelButtonText,
     reverseButtons: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
 }).then(function(result){
     if(result.value){
        window.livewire.emit(event.detail.action);
     }
 });
});