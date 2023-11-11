  const __postRequest=async (url,data,callback=null)=>
  {
    const _token=document.querySelector('meta[name="csrf-token"]').content;
    const rawResponse =  await fetch(url, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN':_token,
    },
    body: JSON.stringify(data)
  });  
      let response=await rawResponse.json();
       if(callback)
       {
           callback(response.message,response.type,response);
       }

         return response;
       
  }


  const updateThemeSettings=()=>
  {
    let previousStorage=sessionStorage;
    setTimeout(function(){
    
    if(sessionStorage){

    var url=THEME_SETTING_URL;

    var data={'themeSetting':sessionStorage};
     var response=__postRequest(url,data,showSmallMessage);

        response.then(function(data){
          //console.log(data);
        })
    }

    },1000)
      
  }


  const showSmallMessage=(message,type,response='')=>
  {
    
    Toastify({
          newWindow: true,
          text: message,
          gravity: 'top',
          position: 'right',
          className: "bg-" +type,
          stopOnFocus: true,
          // offset: {
          //   x: toastData.offset ? 50 : 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
          //   y: toastData.offset ? 10 : 0, // vertical axis - can be a number or a string indicating unity. eg: '2em'
          // },
          duration: 3000,
          close: true,
          // style:{
          //   background: "linear-gradient(to right, #0AB39C, #405189)"
          // },
        }).showToast();

  }

  
function fireSuccessSwal(title,message){
  Swal.fire({
        title: title, 
        text: message, 
        type: "success",
        icon: "success",
        confirmButtonText: "Okay",
        confirmButtonColor: "#04a9f5"
    });
}

function fireWarningSwal(title,message){
  Swal.fire({
        title: title, 
        text: message, 
        type: "warning",
        icon: "warning",
        confirmButtonText: "Okay",
        confirmButtonColor: "#04a9f5"
    });
}

function fireErrorSwal(title,message){
  Swal.fire({
        title: title, 
        text: message, 
        type: "error",
        icon: "error",
        confirmButtonText: "Okay",
        confirmButtonColor: "#04a9f5"
    });
}

function fireConfirmSwal(title,message){
  Swal.fire({
      title: title,
      text: message,
      icon: "warning",
      showDenyButton: true,  
      showCancelButton: true,  
      confirmButtonText: `Yes, I am sure`,  
      denyButtonText: `'No, cancel it!`,
  })
}