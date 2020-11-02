const stickyNav = {
   
    cl:'sticky', //
    prevPos:0,
    element(){
        return  document.getElementById('menuTab');
    },
    addOnEl(){
        return  document.getElementById('addSticky');
    },
    

    pos(){
        var topPos = this.element().getBoundingClientRect().top + window.scrollY;
        return topPos;
        
    },
   
 
    
   
   
    action(){
    let pos =  this.pos();

        
   
    if (window.pageYOffset > pos) {
     return true
      } else {
     return false;
      }
  
    }
    

}
export {stickyNav}

