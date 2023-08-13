  
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

$(document).on('click','.pagination  .page-item:nth-last-child(2)', function() {
    $('.main-content').scrollTop(0);
});

 
    $(document).ready(function () {
    var startDate = flatpickr("#from_date", { minDate: null });
    var endDate = flatpickr("#to_date", { minDate: new Date() });
        startDate.set("onChange", function(d) { 
        endDate.set("minDate", new Date(d)); 
    });
    endDate.set("onChange", function(d) { 
        startDate.set("maxDate", d); 
    });
    });
    