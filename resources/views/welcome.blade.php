<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Selector</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .time-selector-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004a99;
        }
        .form-control {
            border-radius: 8px;
            height: 45px;
        }
    </style>
    <script>
        function updateInputField() {
            const unit = document.getElementById('time-unit').value;
            const timeInput = document.getElementById('time-input');
            const timeLabel = document.getElementById('time-label');

            switch (unit) {
                case 'days':
                    timeInput.type = 'number';
                    timeInput.min = '1';
                    timeInput.placeholder = 'Enter number of days';
                    timeLabel.textContent = 'Days';
                    break;
                case 'months':
                    timeInput.type = 'number';
                    timeInput.min = '1';
                    timeInput.placeholder = 'Enter number of months';
                    timeLabel.textContent = 'Months';
                    break;
                case 'hours':
                    timeInput.type = 'number';
                    timeInput.min = '0';
                    timeInput.placeholder = 'Enter number of hours';
                    timeLabel.textContent = 'Hours';
                    break;
                case 'seconds':
                    timeInput.type = 'number';
                    timeInput.min = '0';
                    timeInput.placeholder = 'Enter number of seconds';
                    timeLabel.textContent = 'Seconds';
                    break;
            }
        }
    </script>
</head>
<body>
    <div class="time-selector-container">
        <form action="{{ route('time') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="time-unit" class="form-label">Select Time Unit:</label>
                <select id="time-unit" name="time_unit" class="form-control" onchange="updateInputField()" required>
                    <option value="days">Days</option>
                    <option value="months">Months</option>
                    <option value="hours">Hours</option>
                    <option value="seconds">Seconds</option>
                </select>
            </div>

            <div class="mb-3">
                <label id="time-label" for="time-input" class="form-label">Days</label>
                <input type="number" id="time-input" name="time_value" class="form-control" min="1" placeholder="Enter number of days" required>
            </div>

            <div class="mb-3">
                <label for="start-time" class="form-label">Start Time:</label>
                <input type="datetime-local" id="start-time" name="start_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
