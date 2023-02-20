@extends('default')

@section('content')
<div> 
    <h3>Candidatures Par Formation</h3>
</div>
    <div id="candidatures-par-formation"></div>
<div>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Total</th>
            </tr>
            @if($candidatures->count() != 0)
            @foreach($candidatures as $candidature)
                <tr>
                    <td>{{$candidature->nom}}</td>
                    <td>{{$candidature->total}}</td>
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="2"><h2>Desolee Aucune donnée a representer</h2></td>
            </tr>
            @endif
        </table>
</div>
@section('scripts')
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script>
        // ... code de visualisation des données ...

        var data =  {!! json_encode($candidatures) !!};

        console.log(data)
        var margin = {top: 20, right: 18, bottom: 30, left: 140},
            width = 960 - margin.left - margin.right,
            height = 500 - margin.top - margin.bottom;

        var x = d3.scaleLinear()
            .range([0, width])
            .domain([0, d3.max(data, function(d) { return d.total; })]);

        var y = d3.scaleBand()
            .range([height, 1])
            .padding(0.1)
            .domain(data.map(function(d) { return d.nom; }));

        var svg = d3.select("#candidatures-par-formation").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("width", function(d) { return x(d.total); })
            .attr("y", function(d) { return y(d.nom); })
            .attr("height", y.bandwidth());

        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x));

        svg.append("g")
            .call(d3.axisLeft(y));
    </script>

@endsection

    
@endsection
