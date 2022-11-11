import React from 'react'
import Button from './button'
import PropTypes from 'prop-types'

const Header = (props) => {
    const onClick = () =>{
    console.log('click');
    // console.log(e);
}
  return (
    <header className='header'>
        {/* <h1 style={{color: 'red', backgroundColor: 'black'}}>{props.title}</h1> */}
        {/* <h1 style={headingStyle}>{props.title}</h1> */}
        <h1>{props.title}</h1>
        {/* <Button onClick={onClick} color='green' text='Add' textColor='white' /> */}
    </header>
  )
}

Header.defaultProps = {
    title:'Basic Task Tracker',
}

Header.propTypes={
    title:PropTypes.string.isRequired,
}

const headingStyle={
    color: 'red',
    backgroundColor: 'black'
}

export default Header