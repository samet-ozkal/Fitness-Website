<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekipmansız Günlük Antrenman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: orange;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #f2f2f2;
        }
        td {
            border-bottom: 1px solid #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: firebrick;
            margin-top: 30px;
        }
        .day {
            font-weight: bold;
        }
        .exercise-image {
            width: 75px;
            height: 75px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
        }
        .form-container input,
        .form-container select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container button {
            background-color: orange;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #ff8c00;
        }

        .exercise-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.day-container {
    width: 100%;
    position: relative;
    background: white;
}
.day-container:nth-child(odd) {
    background: #e7e7e7;

}

.day {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translate(-50%, -50%);
}

.exercise-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px;
}

.exercise {
    width: 100%;
    margin-bottom: 20px;
    text-align: center;
    position: relative;
}

.exercise-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.exercise-name {
    font-weight: bold;
}

.exercise-set {
    font-size: 14px;
    color: #666;
    position: absolute;
    right: 0;
    top: 50%;
    transform: translate(-50%, -50%);
}

.set-count {
    display: flex;
    flex-wrap: wrap;
}

.set {
    width: 30%;
    margin-bottom: 10px;
    text-align: center;
    border: 1px solid #ccc;
    padding: 5px;
}
    </style>
</head>
<body>

<h1>Ekipmansız Günlük Antrenman</h1>
<div class="exercise-container">
    <?php
    // Veritabanı bağlantısı
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login";

    // Veritabanına bağlan
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Günleri sıralamak için bir dizi oluştur
    $gunler = array("Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar");

    // PHP kodu ile egzersiz içeriğini doldurma
    foreach ($gunler as $gun) {
        $sql = "SELECT * FROM exercises8 WHERE day = '$gun'";
        $result = $conn->query($sql);

        echo "<div class='day-container'>";
        echo "<div class='day'>$gun</div>";
        echo "<div class='exercise-list'>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePaths = explode(",", $row["imagePath"]);
                $exerciseNames = explode(",", $row["exerciseName"]);
                $setCounts = explode(",", $row["setCount"]);

                // Her bir egzersiz için tüm set sayılarını ve egzersizleri yan yana listeleyin
                for ($i = 0; $i < count($imagePaths); $i++) {
                    echo "<div class='exercise'>";
                    if (!isset($imagePaths[$i]) || empty($imagePaths[$i])) {
                        echo "<span class='exercise-name'>{$exerciseNames[$i]}</span>";
                    } else {
                        echo "<img src='{$imagePaths[$i]}' alt='{$exerciseNames[$i]}' class='exercise-image'>";
                        echo "<span class='exercise-name'>{$exerciseNames[$i]}</span>";
                        echo "<span class='exercise-set'>{$setCounts[$i]}</span>";
                    }
                    echo "</div>";
                }
            }
        } else {
            echo "Dinlenme";
        }
        echo "</div>";

        echo "<div class='set-count'>";
        if ($result->num_rows > 0) {
            // Tüm egzersizlerin set sayılarını bir diziye topla
            $allSetCounts = array();
            while ($row = $result->fetch_assoc()) {
                $setCounts = explode(",", $row["setCount"]);
                $allSetCounts = array_merge($allSetCounts, $setCounts);
            }

            // Egzersizlerin set sayılarını göster
            foreach ($allSetCounts as $setCount) {
                echo "<div class='set'>$setCount</div>";
            }
        } else {
            echo "-";
        }
        echo "</div>";

        echo "</div>"; // day-container
    }
    ?>
</div>
<!-- <table>
    <tr>
        <th>Gün</th>
        <th>Antrenman</th>
        <th>Set Sayısı</th>
    </tr>
    <tr>
        <td class="day">Pazartesi</td>
        <td id="PazartesiAntrenman">
            <img src="https://newlife.com.cy/wp-content/uploads/2019/11/00331301-Barbell-Decline-Bench-Press_Chest_360.gif" alt="Bench Press" class="exercise-image"> Bench Press<br>
            <img src="https://newlife.com.cy/wp-content/uploads/2019/11/03081301-Dumbbell-Fly_Chest-FIX_360.gif" alt="Dumbbell Flyes" class="exercise-image"> Dumbbell Flyes<br>
            <img src="https://fitnessvolt.com/wp-content/uploads/2015/08/parallel-bar-dips.gif" alt="Weighted Dips" class="exercise-image"> Weighted Dips<br>
            <img src="https://newlife.com.cy/wp-content/uploads/2019/11/03191301-Dumbbell-Incline-Fly_Chest-FIX_360-1.gif" alt="Chest Flyes" class="exercise-image"> Chest Flyes
        </td>
        <td id="PazartesiSetSayisi">3 x 6 - 8<br><br><br><br>4 x 6 - 8<br><br><br><br>3 x 6 - 8<br><br><br><br>3 x 8 - 10 </td>
    </tr>
    <tr>
        <td class="day">Salı</td>
        <td id="SalıAntrenman">
            <img src="https://homeworkouts.org/wp-content/uploads/anim-kettlebell-split-snatch.gif" alt="Squat" class="exercise-image">
            Kettlebell Split Snatch<br>
            <img src="https://homeworkouts.org/wp-content/uploads/anim-forward-lunges.gif" alt="Lunges" class="exercise-image">
            Lunges<br>
            <img src="https://static.wixstatic.com/media/00b9a7_90cfe929001b46b7b4b499c8bf73b03d~mv2.gif" alt="Barbellsquat" class="exercise-image">
            Barbell Squat
        </td>
        <td id="SalıSetSayisi">3 x 15<br><br><br><br>4 x 12<br><br><br><br>3 x 15</td>
    </tr>
    <tr>
        <td class="day">Çarşamba</td>
        <td id="ÇarşambaAntrenman">
            Dinlenme
        </td>
        <td id="ÇarşambaSetSayisi">-</td>
    </tr>
    <tr>
        <td class="day">Perşembe</td>
        <td id="PerşembeAntrenman">
            <img src="https://static.wixstatic.com/media/00b9a7_6d54b8b55a7b4a059cdffe42c3e0e7a7~mv2.gif" alt="Pull-ups" class="exercise-image">
            Pull-ups<br>
            <img src="https://fitnessprogramer.com/wp-content/uploads/2021/02/Bent-Over-Dumbbell-Row.gif" alt="Bent Over Rows" class="exercise-image">
            Bent Over Rows<br>
            <img src="https://static.wixstatic.com/media/00b9a7_4b0c68c711ae4944b2574af2134884ce~mv2.gif" alt="Cable-row" class="exercise-image">
            Standing Cable Row<br>
            <img src="https://static.wixstatic.com/media/00b9a7_788b9ea6c0f542b08a26e0c21fc4ac90~mv2.gif" alt="pullover" class="exercise-image">
            Pullover
        </td>
        <td id="PerşembeSetSayisi">2 x 10 - 12<br><br><br><br>3 x 12<br><br><br><br>3 x 15<br><br><br><br>4 x 12</td>
    </tr>
    <tr>
        <td class="day">Cuma</td>
        <td id="CumaAntrenman">
            <img src="https://static.wixstatic.com/media/00b9a7_c55fba8719934a48834844cab00214f5~mv2.gif" alt="Dumbbell-Shoulder-Press" class="exercise-image">
            Dumbbell Shoulder Press<br>
            <img src="https://static.wixstatic.com/media/00b9a7_cb51e8eeb4344e56a70dc049589e886e~mv2.gif" alt="Lateral-Raises" class="exercise-image">
            Lateral Raises<br>
            <img src="https://i.pinimg.com/originals/2b/ef/ba/2befbad569f6f8ad31fe03a77cf45ab6.gif" alt="cuban-press" class="exercise-image">
            Dumbbell Cuban Press<br>
            <img src="https://i.pinimg.com/originals/dd/01/d7/dd01d7f4b5a021849ab0a3e1a7f54c49.gif" alt="Front-Plate-Raise" class="exercise-image">
            Front Plate Raise
        </td>
        <td id="CumaSetSayisi">3 x 12 <br><br><br><br>3 x 15<br><br><br><br>2 x 15<br><br><br><br>3 x 15</td>
    </tr>
    <tr>
        <td class="day">Cumartesi</td>
        <td id="CumartesiAntrenman">
            <img src="https://cdn-cccio.nitrocdn.com/sQAAylIpwgMYZgBLSXcMgCkUIbfIzHvb/assets/images/optimized/rev-3d9de4c/www.aleanlife.com/wp-content/uploads/2022/11/tricep-exercises-skullcrushers.gif" alt="Dumbbell-Skull-Crushers" class="exercise-image">
            Dumbbell Skull Crushers<br>
            <img src="https://fitliferegime.com/wp-content/uploads/2022/08/How-To-Do-Tricep-Dips.gif" alt="Tricep-Dips" class="exercise-image">
            Tricep Dips<br>
            <img src="https://fitnessvolt.com/wp-content/uploads/2023/09/cable-tricep-pushdown.gif" alt="Cable-Triceps-Pushdowns" class="exercise-image">
            Cable Triceps Pushdowns<br>
            <img src="https://fitnessvolt.com/wp-content/uploads/2023/09/parallel-bar-dips.gif" alt="Parallel-bar-dips" class="exercise-image">
            Parallel bar dips


        </td>
        <td id="CumartesiSetSayisi">3 x 12<br><br><br><br>2 x 15<br><br><br><br>4 x 12<br><br><br><br>3 x 15</td>
    </tr>
    <tr>
        <td class="day">Pazar</td>
        <td id="PazarAntrenman">Dinlenme</td>
        <td id="PazarSetSayisi">-</td>
    </tr>
</table> -->

<div class="form-container">
    <h2>Egzersiz Ekle</h2>
    <form method="post" action="./egzersiz_ekle8.php" enctype="multipart/form-data">
        <label for="day">Gün:</label>
        <select id="day" name="day">
            <option value="Pazartesi">Pazartesi</option>
            <option value="Salı">Salı</option>
            <option value="Çarşamba">Çarşamba</option>
            <option value="Perşembe">Perşembe</option>
            <option value="Cuma">Cuma</option>
            <option value="Cumartesi">Cumartesi</option>
            <option value="Pazar">Pazar</option>
        </select><br>
        <label for="exerciseName">Egzersiz Adı:</label>
        <input type="text" id="exerciseName" name="exerciseName"><br>
        <label for="exerciseImage">Fotoğraf:</label>
        <input type="file" id="exerciseImage" name="exerciseImage"><br>
        <label for="setCount">Set Sayısı:</label>
        <input type="text" id="setCount" name="setCount"><br>
        <button type="submit" >Egzersiz Ekle</button>
    </form>
</div>

<!-- <script>
    window.onload = loadExercises;
    window.addEventListener('DOMContentLoaded', loadExercises);
    window.addEventListener('beforeunload', saveExercises);
    
    function loadExercises() {
    for (let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        if (key.startsWith("exercise_")) {
            let exercise = JSON.parse(localStorage.getItem(key));
            addExerciseToTable(exercise.day, exercise.exerciseName, exercise.exerciseImage, exercise.setCount);
        }
    }
}
    
    // Egzersiz ekleme işlevi
    function addExercise() {
        var form = document.getElementById("exerciseForm");
        var day = form.elements["day"].value;
        var exerciseName = form.elements["exerciseName"].value;
        var exerciseImage = form.elements["exerciseImage"].files[0];
        var setCount = form.elements["setCount"].value;
    
        var exerciseKey = "exercise_" + day + "_" + exerciseName.replace(/\s+/g, '-').toLowerCase();
        var exercise = {
            day: day,
            exerciseName: exerciseName,
            exerciseImage: exerciseImage,
            setCount: setCount
        };
    
        // Egzersizi yerel depolamada sakla
        localStorage.setItem(exerciseKey, JSON.stringify(exercise));
    
        // Sayfada göster
        addExerciseToTable(day, exerciseName, exerciseImage, setCount);
    }
    
    // Egzersizi tabloya ekleme işlevi
    function addExerciseToTable(day, exerciseName, exerciseImage, setCount) {
    var exerciseCell = document.getElementById(day + "Antrenman");
    var setCell = document.getElementById(day + "SetSayisi");

    if (!exerciseCell.innerHTML.includes(exerciseName)) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var exerciseDiv = document.createElement("div");
            var exerciseImg = document.createElement("img");
            var exerciseButton = document.createElement("button");
            
            exerciseDiv.className = "exercise-entry";
            exerciseImg.src = event.target.result;
            exerciseImg.alt = exerciseName;
            exerciseImg.className = "exercise-image";
            exerciseButton.innerHTML = "Sil";
            exerciseButton.className = "remove-button";
            exerciseButton.onclick = function() {
                removeExercise(day, exerciseName);
            };

            exerciseDiv.appendChild(exerciseImg);
            exerciseDiv.appendChild(document.createTextNode(exerciseName));
            exerciseDiv.appendChild(exerciseButton);
            
            exerciseCell.appendChild(exerciseDiv);
        };
        reader.readAsDataURL(exerciseImage);

        setCell.innerHTML += '<br>' + setCount + '<br><br><br><br>';
    }
}
    
    // Egzersizi silme işlevi
    function removeExercise(day, exerciseName) {
        var exerciseKey = "exercise_" + day + "_" + exerciseName.replace(/\s+/g, '-').toLowerCase();
        localStorage.removeItem(exerciseKey);
    
        // Yeniden yükleme olmadan silinmiş egzersizin tablodan kaldırılması
        var exerciseCell = document.getElementById(day + "Antrenman").getElementsByClassName('exercise-entry');
        for (var i = 0; i < exerciseCell.length; i++) {
            var name = exerciseCell[i].getElementsByTagName('img')[0].alt;
            if (name === exerciseName) {
                exerciseCell[i].remove();
                break;
            }
        }
    }
    </script> -->

<style>
    .remove-button {
        background-color: #ff5555;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
    }
</style>



</body>
</html>
