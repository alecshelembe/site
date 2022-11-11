import {useEffect,useState} from 'react';

function MyEffect() {
    const [count, setcount] = useState(0)
    useEffect(() =>{
        alert('hello side effect')
    })
    var buttonText = 'Button Click..';
    return (
    <button onClick={() => setcount(count + 1)}>
      {buttonText}{count}
    </button>
  );
}

export default MyEffect;
