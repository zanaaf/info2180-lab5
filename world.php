<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'] ?? '';
$type = $_GET['type'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($type == "cities"){
$stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities
INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");

$stmt->execute(['country' => "%$country%"]);

}
else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
  <table>
    <?php if ($type=='cities'):?>
      <thead>
      <tr>
        <th>City Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>
      <tbody>
      <?php foreach ($results as $row):?>
        <tr>
          <td><?=htmlspecialchars($row['name']);?></td>
          <td><?=htmlspecialchars($row['district']);?></td>
          <td><?=htmlspecialchars($row['population']);?></td>
        </tr>
    <?php endforeach;?>
    <?php else:?>
      <thead>
      <tr>
        <th>Country Name</th>
        <th>Continent</th>
        <th>Independence Year</th>
        <th>Head of State</th>
      </tr>
    </thead>
      <tbody>
    <?php foreach ($results as $row):?>
        <tr>
          <td><?=htmlspecialchars($row['name']);?></td>
          <td><?=htmlspecialchars($row['continent']);?></td>
          <td><?=htmlspecialchars($row['independence_year']);?></td>
          <td><?=htmlspecialchars($row['head_of_state']);?></td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
      </tbody>
    </table>