document.addEventListener("DOMContentLoaded", ()=> {
    document.getElementById('saveAsButton').addEventListener('click', async function() {
        if ('showSaveFilePicker' in window) {
            // Use the showSaveFilePicker API if available
            try {
                const newDate = new Date();
                const year = newDate.getFullYear();
                const month = newDate.getMonth()+1;
                const day = newDate.getDate();
                const time = newDate.getHours().toString() + newDate.getMinutes().toString() + newDate.getSeconds().toString();

                const fileHandle = await window.showSaveFilePicker({
                    suggestedName: 'database_backup' + '('+ year +'-'+ month +'-'+ day + '-' + time +')' + '.sql',
                    types: [{
                        description: 'SQL Backup Files',
                        accept: {'application/octet-stream': ['.sql']}
                    }]
                });
    
                // Fetch the PHP script to get the backup file
                const response = await fetch('utility/backup.php', {
                    method: 'POST'
                });
    
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
    
                const blob = await response.blob();
                const writableStream = await fileHandle.createWritable();
                await writableStream.write(blob);
                await writableStream.close();
                $('#success4').modal('show');
                
            } catch (error) {
                if (error.name !== 'AbortError') {
                    console.error('An error occurred during the save operation:', error);
                }
            }
        } else {
            // Fallback to Blob method for unsupported browsers
            const response = await fetch('database_backup.php', {
                method: 'POST'
            });
    
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
    
            const blob = await response.blob();
            const url = URL.createObjectURL(blob);
    
            const a = document.createElement('a');
            a.href = url;
            a.download = 'database_backup.sql';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
    
            $('#modal').modal('show');
        }
    });
    document.getElementById("backupTable").addEventListener("submit" , async function(e) {
        e.preventDefault();
        const checkboxes = document.querySelectorAll('#backupTable input[type="checkbox"]:checked');
        const selectedTables = Array.from(checkboxes).map(checkbox => checkbox.value);

        if (checkboxes.length > 0){
            if ('showSaveFilePicker' in window) {
                // Use the showSaveFilePicker API if available
                try {
                    const newDate = new Date();
                    const year = newDate.getFullYear();
                    const month = newDate.getMonth()+1;
                    const day = newDate.getDate();
                    const time = newDate.getHours().toString() + newDate.getMinutes().toString() + newDate.getSeconds().toString();
    
                    const fileHandle = await window.showSaveFilePicker({
                        suggestedName: 'database_backup' + '('+ year +'-'+ month +'-'+ day + '-' + time +')' + '.sql',
                        types: [{
                            description: 'SQL Backup Files',
                            accept: {'application/octet-stream': ['.sql']}
                        }]
                    });
                    const formData =  new FormData();
                    selectedTables.forEach(table=> formData.append('tables[]', table))
                    // Fetch the PHP script to get the backup file
                    const response = await fetch('utility/backupspecific.php', {
                        method: 'POST',
                        body:formData,
                    });
        
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
        
                    const blob = await response.blob();
                    const writableStream = await fileHandle.createWritable();
                    await writableStream.write(blob);
                    await writableStream.close();
        
                    alert('File saved successfully!');
                    document.getElementById("backupTable").reset();
                    $("#backupSpecific").modal('hide');
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('An error occurred during the save operation:', error);
                    }
                }
            } else {
                const formData =  new FormData();
                selectedTables.forEach(table=> formData.append('tables[]', table))
                // Fallback to Blob method for unsupported browsers
                const response = await fetch('backup.php', {
                    method: 'POST',
                    body:formData,
                });
        
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
        
                const blob = await response.blob();
                const url = URL.createObjectURL(blob);
        
                const a = document.createElement('a');
                a.href = url;
                a.download = 'database_backup.sql';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
        
                $('#modal').modal('show');
                document.getElementById("backupTable").reset();
                $("#backupSpecific").modal('hide');
            }
        } else {
            $("#failed6").modal('show');
        }
        
    })
    

}) //eND OF rEADY