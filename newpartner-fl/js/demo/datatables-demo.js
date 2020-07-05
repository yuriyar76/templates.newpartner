// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable(
      {
        "scrollX": true,
        "columnDefs": [
          {
            "targets": [ 2 ],
            "searchable": false
          },
          {
            "targets": [ 8 ],
            "searchable": false
          }
        ],
        "order": [[ 0, "desc" ]],
         "language": {
             "processing": "Подождите...",
            "search": "Поиск:",
            "lengthMenu": "Показать _MENU_ записей",
            "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
            "infoEmpty": "Записи с 0 до 0 из 0 записей",
            "infoFiltered": "(отфильтровано из _MAX_ записей)",
            "infoPostFix": "",
            "loadingRecords": "Загрузка записей...",
            "zeroRecords": "Записи отсутствуют.",
            "emptyTable": "В таблице отсутствуют данные",
            "paginate": {
            "first": "Первая",
            "previous": "Предыдущая",
            "next": "Следующая",
            "last": "Последняя"
            },
            "aria": {
              "sortAscending": ": активировать для сортировки столбца по возрастанию",
                  "sortDescending": ": активировать для сортировки столбца по убыванию"
            }
  }

      }
  );
});
