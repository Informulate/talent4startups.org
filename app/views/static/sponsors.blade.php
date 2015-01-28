@extends('layouts.default')

@section('content')
    <h2>Sponsors</h2>

    <p>A full list of supported css elements and examples can be found at:</p>
    <ul>
        <li><a href="http://getbootstrap.com/css/">http://getbootstrap.com/css/</a></li>
        <li><a href="http://www.monolinea.com/projects/styleguide/">http://www.monolinea.com/projects/styleguide/</a></li>
    </ul>


    <h3>History</h3>
    <div class="row">
        <div class="col-md-4">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dui nec magna efficitur varius. Donec vehicula turpis at vestibulum mollis. Phasellus a est eget justo accumsan blandit. Phasellus vestibulum turpis at dapibus vehicula. Integer venenatis tincidunt ultricies. Sed non sapien vulputate, dapibus mi in, tincidunt leo. Ut at magna vel risus venenatis hendrerit. Vestibulum suscipit nisi arcu, a ornare leo ornare eu.</p>
        </div>
        <div class="col-md-3">
            <img data-src="holder.js/300x300" alt="..." class="img-thumbnail" />
            <p class="text-muted">Photo description</p>
        </div>
        <div class="col-md-4">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dui nec magna efficitur varius. Donec vehicula turpis at vestibulum mollis. Phasellus a est eget justo accumsan blandit. Phasellus vestibulum turpis at dapibus vehicula. Integer venenatis tincidunt ultricies. Sed non sapien vulputate, dapibus mi in, tincidunt leo. Ut at magna vel risus venenatis hendrerit. Vestibulum suscipit nisi arcu, a ornare leo ornare eu.</p>
        </div>
    </div>
    <img data-src="holder.js/150x150" alt="..." class="img-circle pull-right" />
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dui nec magna efficitur varius. Donec vehicula turpis at vestibulum mollis. Phasellus a est eget justo accumsan blandit. Phasellus vestibulum turpis at dapibus vehicula. Integer venenatis tincidunt ultricies. Sed non sapien vulputate, dapibus mi in, tincidunt leo. Ut at magna vel risus venenatis hendrerit. Vestibulum suscipit nisi arcu, a ornare leo ornare eu.</p>
    <p>Aliquam eros risus, vestibulum at mi dictum, pretium consequat ligula. Fusce quam neque, efficitur in purus ut, euismod vulputate lectus. Suspendisse fermentum sem egestas sapien volutpat sollicitudin.</p>
    <ul>
        <li>Lorem ipsum dolor</li>
        <li>Aliquam eros risus</li>
        <li>Fusce quam neque</li>
    </ul>

    <ol>
        <li>Lorem ipsum dolor</li>
        <li>Aliquam eros risus</li>
        <li>Fusce quam neque</li>
    </ol>

    <h3>Projects</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Heading 1</th>
                <th>Heading 2</th>
                <th>Heading 3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John</td>
                <td>Smith</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>Bob</td>
                <td>Jones</td>
                <td>User</td>
            </tr>
            <tr>
                <td>Jane</td>
                <td>Jetson</td>
                <td>User</td>
            </tr>
            <tr>
                <td>Joe</td>
                <td>Fuser</td>
                <td><strong>Owner</strong></td>
            </tr>
        </tbody>
    </table>
@stop