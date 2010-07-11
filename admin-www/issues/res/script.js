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
