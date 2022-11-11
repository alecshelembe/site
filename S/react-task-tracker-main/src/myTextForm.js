import {useState} from 'react';


function MyTextForm() {
    
    const [title, setTitle] = useState('')
    const handleSubmit = (e) => {
        e.preventDefault();
        const blog={
            title
        };
        console.log(blog);
    }
    return (
    <div>
      <form onSubmit={handleSubmit}>
        <label>
            Title
        </label>
        <input
        type="text"
        required
        value={title}
        onChange={(e) => setTitle(e.target.value)}
        />
        <button
        type="submit">
            Submit
        </button>
      </form>
      <p>
        {title}
      </p>
    </div>
  );
}

export default MyTextForm;
