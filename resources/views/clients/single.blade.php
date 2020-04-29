@extends('layouts.app')

@section('content') 
  <table class="table bg-white">   
        <tbody>
           <tr>
             <td><b>Name</b></td>
             <td>
               <name-edit name="{{$client->name}}" client_id="{{$client->id}}"/>
             </td>
           </tr>
           <tr>
             <td><b>Company</b></td>              
             <td>
              <company-edit company="{{$client->company}}" client_id="{{$client->id}}"/>
              </td>
           </tr>
            <tr>
             <td><b>Email</b></td>
             <td>
              <email-edit email="{{$client->email}}" client_id="{{$client->id}}"/>
              </td>
           </tr>
           <tr>
            <td><b>Indystry</b></td>
             <td>
             
               <industry-edit ind_id="{{$client->industry_id}}"
                 @if($client->industry_id)

                 current="{{$client->industry->name}}"
                 @endif
                client_id="{{$client->id}}"/>               
             
            </td>
           </tr>
           <tr>
            <td><b>Services</b></td>
             <td>
                @if($client->links)
                   <services-edit :services="{{$client->services->toJson()}}" client_id="{{$client->id}}"/>                   
                
               @endif 
              </td> 
           </tr>
           <tr>
            <td><b>Links</b></td>
              <td>

                 <links-edit :links="{{json_encode($links)}}" client_id="{{$client->id}}"/>
            </td>   
           </tr>
           <tr>
             <td><b>Budget</b></td>
             <td> 
              
                  <budget-edit 
                    @if($client->budget)
                      curent="{{$client->budget->curent}}"                   
                       spent="{{$client->budget->spent}}" 
                    @endif
                     client_id="{{$client->id}}"/>           
                 
               
              </td>
           </tr>
           <tr>
            <td><b>Time Frame</b></td>
             <td> 
             

                 <time-edit 
                   @if($client->dev_time)
                     started="{{$client->dev_time->started}}" 
                     time_frame="{{$client->dev_time['time-frame']}}"
                     finished="{{$client->dev_time->finished}}"
                    @endif
                     client_id="{{$client->id}}" />                            
                
             
            </td>
           </tr>
           <tr>
            <td><b>Credentials</b></td>
             <td> 
             

                 <credentials-edit 
                   @if($client->credentials)
                     credentials="{{$client->credentials->toJson()}}"             
                    @endif
                     client_id="{{$client->id}}" />                            
                
             
            </td>
           </tr>
        </tbody>
</table>


@endsection  