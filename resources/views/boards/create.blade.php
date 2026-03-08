<x-layout>
<form action="{{ route('boards.store') }}" method="POST">

    @csrf
    <h2 class="text-3xl font-semibold mb-4">create a new board</h2>
    <x-input class="border-black" label="Enter Your Board Name" name="name" type="text"/>
    <input id="color-input" name="color" type="text" style="display:none;">

    <div class="mb-5">
        <label for="" class="text-l font-semibold mb-4 block">Choose a color for your board:</label>
        <x-color-btn onclick="myFunction(this)" value="red" id="#f87575" class="bg-[#f87575] ml-10 hover:ring-[#f87575]" ></x-color-btn>
        <x-color-btn onclick="myFunction(this)" value="blue" id="#00b4d8" class="bg-[#00b4d8] ml-5 hover:ring-[#00b4d8]" ></x-color-btn>
        <x-color-btn onclick="myFunction(this)" value="green" id="#80ffdb" class="bg-[#80ffdb] ml-5 hover:ring-[#80ffdb]" ></x-color-btn>
        <x-color-btn onclick="myFunction(this)" value="yellow" id="#ffee99" class="bg-[#ffee99] ml-5 hover:ring-[#ffee99]" ></x-color-btn>
        <x-color-btn onclick="myFunction(this)" value="violet" id="#e7c6ff" class="bg-[#e7c6ff] ml-5 hover:ring-[#e7c6ff]" ></x-color-btn>

    </div>
    <x-input class="border-black" label="Enter Discription for your Board" name="discription" type="text"/>


    <x-button>submit</x-button>
</form>
<script>
function myFunction(element)
{
    let value   =   element.getAttribute('id');
    let buttonColor =   element.getAttribute('id');

    document.querySelectorAll('.color-btn').forEach(btn=>{
        btn.classList.remove('ring-2','ring-offset-2');
    });

    let ringColor = `ring-[${buttonColor}]`;

    element.classList.add('ring-2', 'ring-offset-2');
    element.classList.add(ringColor);

    document.getElementById('color-input').setAttribute('value', value);

}
</script>
</x-layout>