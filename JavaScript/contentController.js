var element = "";

function displayFields() {
  $(element).hide();
  element = "#" + $('#action').val().toLowerCase() + "-" + $('#type').val().toLowerCase();
  $(element).show();
  console.log(element);
};

function init() {
  $('#action').change(displayFields);
  $('#type').change(displayFields);
};

$(document).ready(init);
