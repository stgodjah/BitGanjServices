function fetchParams () {
  var params = JSON.parse(localStorage.getItem('params'));
  var paramsList = document.getElementById('paramsList');

  paramsList.innerHTML = '';

  for (var i = 0; i < params.length; i++) {
    var id = params[i].id;
    var user = params[i].user;
    var pass = params[i].pass;
    var proxy = params[i].proxy;


    paramsList.innerHTML +=   '<div class="well">'+
                              '<h6>Issue ID: ' + id + '</h6>'+
                              '<p><span class="label label-info">' + user + '</span></p>'+
                              '<h3>' + pass+ '</h3>' + 
                              '<h3>' + proxy + '</h3>' + 
                              '<a href="#" class="btn btn-warning" onclick="checkParams(\''+id+'\')">Active</a> '+
                              '<a href="#" class="btn btn-danger" onclick="deleteParams(\''+id+'\')">Delete</a>'+
                              '</div>';
  }
}

function saveParams(e) {
  var paramId = chance.guid();
  var paramUser = document.getElementById('paramsUser').value;
  var paramPass = document.getElementById('paramsPass').value;
  var paramProxy = document.getElementById('paramsProxy').value;
  var param = {
    id: paramId,
    user: paramUser,
    pass: paramPass,
    proxy: paramProxy
  }

  if (localStorage.getItem('params') === null) {
    var params = [];
    params.push(param);
    localStorage.setItem('params', JSON.stringify(params));
  } else {
    var params = JSON.parse(localStorage.getItem('params'));
    params.push(param);
    localStorage.setItem('params', JSON.stringify(params));
  }

  document.getElementById('paramsInputForm').reset();

  fetchIssues();

  e.preventDefault();
}

document.getElementById('paramsInputForm').addEventListener('submit', saveParams);

function checkParams (id) {
  var params = JSON.parse(localStorage.getItem('params'));

  for(var i = 0; i < params.length; i++) {
    if (params[i].id == id) {
      var vP = params[i];
      var vUrl = "?user=" + vP.user + "&pass=" + vP.pass + "&proxy=" + vP.proxy;
      window.open(vUrl,'_blank');
    }
  }
}

function deleteIssue (id) {
  var params = JSON.parse(localStorage.getItem('params'));

  for(var i = 0; i < params.length; i++) {
    if (params[i].id == id) {
      params.splice(i, 1);
    }
  }

  localStorage.setItem('params', JSON.stringify(params));

  fetchParams();
}