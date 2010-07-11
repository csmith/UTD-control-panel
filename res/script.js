function validateLoginForm () {
  var error = false;
  
  document.getElementById('username').className = 'inflat';
  document.getElementById('usernamevalid').innerHTML = '';
  document.getElementById('password').className = 'inflat';
  document.getElementById('passwordvalid').innerHTML = '';  
  
  if (document.forms.login.password.value.length < 4) {
    error = true;
    document.getElementById('password').className = 'inflaterr';
    document.getElementById('passwordvalid').innerHTML = 'Passwords must be at least four characters long.';
    document.getElementById('password').focus();
  }
  
  if (document.forms.login.username.value.length < 2) {
    error = true;
    document.getElementById('username').className = 'inflaterr';
    document.getElementById('usernamevalid').innerHTML = 'Usernames must be at least two characters long.';
    document.getElementById('username').focus();
  }
  
  return (error == false);
}

function validateSubdomainForm () {
  var error = false;

  document.getElementById('subdomain').className = 'inflat';
  document.getElementById('subdomainerr').innerHTML = '';

  if (document.forms.submd.subdomain.value.length == 0) {
    error = true;
    document.getElementById('subdomain').className = 'inflaterr';
    document.getElementById('subdomainerr').innerHTML = 'You must enter a subdomain';
    document.getElementById('subdomain').focus();
  }

  var valid = /^[a-z][a-z0-9\-]*$/i;
  if (!valid.test(document.forms.submd.subdomain.value)) {
    error = true;
    document.getElementById('subdomain').className = 'inflaterr';
    document.getElementById('subdomainerr').innerHTML = 'Invalid subdomain.';
    document.getElementById('subdomain').focus();
  }

  return (error == false);
}

function validateDomainForm () {
  var error = false;

  document.getElementById('domain').className = 'inflat';
  document.getElementById('domainerr').innerHTML = '';

  if (document.forms.md.domain.value.length == 0) {
    error = true;
    document.getElementById('domain').className = 'inflaterr';
    document.getElementById('domainerr').innerHTML = 'You must enter a domain';
    document.getElementById('domain').focus();
  }
  
  var valid = /^[a-z][a-z0-9\-\.]*\.[a-z]{2,}$/i
  if (!valid.test(document.forms.md.domain.value)) {
    error = true;
    document.getElementById('domain').className = 'inflaterr';
    document.getElementById('domainerr').innerHTML = 'Invalid domain.';
    document.getElementById('domain').focus();
  }

  return (error == false);
}

function validateTicketForm () {
  var error = false;
  
  document.getElementById('body').className = 'inflat';
  document.getElementById('messagevalid').innerHTML = '';
  document.getElementById('subject').className = 'inflat';
  document.getElementById('subjectvalid').innerHTML = '';  
  
  if (document.forms.ticket.body.value.length < 10) {
    error = true;
    document.getElementById('body').className = 'inflaterr';
    document.getElementById('messagevalid').innerHTML = 'Please enter a complete description of the problem.';
    document.getElementById('body').focus();
  }
  
  if (document.forms.ticket.subject.value.length < 5) {
    error = true;
    document.getElementById('subject').className = 'inflaterr';
    document.getElementById('subjectvalid').innerHTML = 'Please enter a complete subject.';
    document.getElementById('subject').focus();
  }
  
  return (error == false);
}

//
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
//
function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}


	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}
