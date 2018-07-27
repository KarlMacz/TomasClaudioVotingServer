@extends('layouts.admin')

@section('resources')
    <script>
        $(document).ready(function() {
            $('body').on('change', '#college-field', function() {
                var selectedCollege = $(this).find('option:selected').val();
                var availableCourses = null;

                switch(selectedCollege) {
                    case 'College of Arts and Sciences':
                        availableCourses = [
                            'Bachelor of Science in Nursing',
                            'Bachelor of Science in Midwifery',
                            'Bachelor of Science in Physical Theraphy',
                            'Bachelor of Arts Major in Economics',
                            'Bachelor of Arts Major in English',
                            'Bachelor of Arts Major in History',
                            'Bachelor of Science in Criminology',
                            'Associate in Arts in Police and Public Administration'
                        ];

                        break;
                    case 'College of Business & Accountancy':
                        availableCourses = [
                            'Bachelor of Science in Accountancy',
                            'Bachelor of Science in Business Administration Major in Business Economics',
                            'Bachelor of Science in Business Administration Major in Financial Management',
                            'Bachelor of Science in Business Administration Major in Human Resource Development Management',
                            'Bachelor of Science in Business Administration Major in Marketing Management',
                            'Bachelor of Science in Business Administration Major in Operations Management',
                            'Bachelor of Science in Business Administration Major in Financial and Management Accounting',
                            'Bachelor of Science in Public Administration',
                            'Associate in Business Administration',
                            'Associate in Computer Secretarial'
                        ];

                        break;
                    case 'College of Information Technology':
                        availableCourses = [
                            'Bachelor of Science in Computer Science',
                            'Associate in Computer Technology'
                        ];

                        break;
                    case 'College of Education':
                        availableCourses = [
                            'Bachelor of Elementary Education',
                            'Bachelor of Secondary Education Major in English',
                            'Bachelor of Secondary Education Major in Filipino',
                            'Bachelor of Secondary Education Major in Mathematics',
                            'Bachelor of Secondary Education Major in Social Studies',
                            'Bachelor of Secondary Education Major in Values Education',
                            'Bachelor of Secondary Education Major in Biological and Physical Science',
                            'Bachelor of Secondary Education Major in MAPEH'
                        ];

                        break;
                    case 'College of Hotel and Restaurant Management':
                        availableCourses = [
                            'Bachelor of Science in Hotel and Restaurant Management'
                        ];

                        break;
                    default:
                        availableCourses = null;

                        break;
                }

                $('#course-field').html('<option value="" selected disabled>Select an option...</option>');

                if(availableCourses !== null) {
                    for(var i = 0; i < availableCourses.length; i++) {
                        $('#course-field').append('<option value="' + availableCourses[i] + '">' + availableCourses[i] + '</option>');
                    }
                }

                return false;
            });
        });
    </script>
@endsection

@section('content')
    <div class="body-content admin">
        <div class="sidebar">
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">MENU</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.index') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.get.election_results') }}">Election Results</a></li>
                <li><a href="{{ route('admin.get.voter_reset') }}">Voter Reset</a></li>
                <li><a href="{{ route('admin.get.settings') }}">System Settings</a></li>
            </ul>
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">DATA MANAGEMENT</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.candidates') }}">Candidates</a></li>
                <li><a href="{{ route('admin.get.parties') }}">Parties</a></li>
                <li><a href="{{ route('admin.get.positions') }}">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}" class="active">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <a href="{{ route('admin.get.voters') }}" class="admin-navbar-button"><span class="fas fa-chevron-left"></span></a>
                <div class="admin-navbar-title">Add Voter Information</div>
            </div>
            @include('partials.flash')
            <div class="container wide">
                <form action="{{ route('admin.get.voters_store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="column span-12">
                            <div class="input-group">
                                <label for="username-field">Username:</label>
                                <input type="text" name="username" id="username-field" class="input-control" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column span-4">
                            <div class="input-group">
                                <label for="first-name-field">First Name:</label>
                                <input type="text" name="first_name" id="first-name-field" class="input-control" required autofocus>
                            </div>
                        </div>
                        <div class="column span-4">
                            <div class="input-group">
                                <label for="middle-name-field">Middle Name:</label>
                                <input type="text" name="middle_name" id="middle-name-field" class="input-control">
                            </div>
                        </div>
                        <div class="column span-4">
                            <div class="input-group">
                                <label for="last-name-field">Last Name:</label>
                                <input type="text" name="last_name" id="last-name-field" class="input-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column span-6">
                            <div class="input-group">
                                <label for="gender-field">Gender:</label>
                                <select name="gender" id="gender-field" class="input-control" required>
                                    <option value="" selected disabled>Select an option...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="column span-6">
                            <div class="input-group">
                                <label for="email-field">E-mail Address:</label>
                                <input type="text" name="email" id="email-field" class="input-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column span-6">
                            <div class="input-group">
                                <label for="college-field">College:</label>
                                <select name="college" id="college-field" class="input-control" required>
                                    <option value="" selected disabled>Select an option...</option>
                                    @include('partials.option_colleges')
                                </select>
                            </div>
                        </div>
                        <div class="column span-6">
                            <div class="input-group">
                                <label for="course-field">Course:</label>
                                <select name="course" id="course-field" class="input-control" required>
                                    <option value="" selected disabled>Select an option...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group text-right">
                        <button type="submit" class="button primary"><span class="fas fa-plus"></span> Add Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
