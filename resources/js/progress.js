document.onreadystatechange = function(e)
{
  if(document.readyState=="interactive")
  {
    var all = document.getElementsByTagName("*");  
    for (var i=0, max = all.length; i < max; i++) 
    {
      set_ele(all[i]);
    }
  }
}

function check_element(ele)
{
  var all = document.getElementsByTagName("*");
   
  var per_inc = 100/all.length;

  if($(ele).on())
  {
    var prog_width = per_inc+Number(document.getElementById("main_progress_width").value);
    document.getElementById("main_progress_width").value = prog_width;


    $("#main_progress_bar1").animate({width:prog_width+"%"},10,function(){
      if(document.getElementById("main_progress_bar1").style.width == "100%")
      {
        $(".main_progress_progress").fadeOut("slow");
      }			
    });
  }

  else	
  {
    set_ele(ele);
  }
}

function set_ele(set_element)
{
  check_element(set_element);
}