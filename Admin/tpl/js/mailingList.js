Event.observe(window, 'load', init, false);
function init() {
  Event.observe('addressForm', 'submit', storeAddress);
}
function storeAddress(e) {
  $('response').innerHTML = 'Adding email address...';
  var pars = 'address=' + escape($F('address'));
  var myAjax = new Ajax.Updater('response', 'ajaxServer.php', {method: 'get', parameters: pars});
  Event.stop(e);
}