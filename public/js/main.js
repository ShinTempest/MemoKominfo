$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

  $('.date').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'id',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    },
    inline: true
  }).on('dp.change', function (e) {
      var tzoffset = (new Date()).getTimezoneOffset() * 60000;
      var date = $('.date').data("DateTimePicker").date()._d;
      var localIsoDate = new Date(date - tzoffset).toISOString().slice(0, 10)
      updateChart(localIsoDate);
  });

  $('.datetime').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    locale: 'id',
    sideBySide: true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.timepicker').datetimepicker({
    format: 'HH:mm:ss',
    locale: 'id',
      icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', '')
    $select2.trigger('change')
  })

  $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })

$('button.sidebar-toggler').click(function () {
    setTimeout(function() {
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    }, 275);
  })
})

function readFile(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
  var htmlPreview =
  '<img width="200" src="' + e.target.result + '" />'+
  '<p>' + input.files[0].name + '</p>';
  var wrapperZone = $(input).parent();
  var previewZone = $(input).parent().parent().find('.preview-zone');
  var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

  wrapperZone.removeClass('dragover');
  previewZone.removeClass('hidden');
  boxZone.empty();
  boxZone.append(htmlPreview);
  };

  reader.readAsDataURL(input.files[0]);
  }
 }
 function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
 }
 $(".dropzone").change(function(){
  readFile(this);
 });
 $('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
 });
 $('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
 });
 $('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
 });
