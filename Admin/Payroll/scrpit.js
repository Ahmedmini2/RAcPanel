var btnXlsx = document.querySelectorAll('download-button')

btnXlsx.onclick =() => exportData('xlsx')

function exportData(type){
    const fileName = 'exported-sheet.' + type
    const table = document.getElementById("table")
    const wb = XLSX.utils.table_to_book(table)
    XLSX.writeFile(wb, fileName)
}