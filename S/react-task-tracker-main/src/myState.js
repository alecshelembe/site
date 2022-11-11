import {useState} from 'react';

function MyState() {
    const [count, setcount] = useState(0)
    var buttonText = 'Button Click..';
    return (
    <button onClick={() => setcount(count + 1)}>
      {buttonText}{count}
    </button>
  );
}

export default MyState;
