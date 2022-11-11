import React from 'react'
import PropTypes from 'prop-types'

const Button = ({color,text,textColor,onClick}) => {
// const onClick = (e) =>{
//     console.log('click');
//     // console.log(e);
// }
    // return <button onClick={onClick} style={{backgroundColor:color, color:textColor}} className='btn'>{text}</button>
    return <button onClick={onClick}  style={{backgroundColor:color, color:textColor}} className='btn'>{text}</button>
}

Button.defualtProps = {
    color: 'steelblue'
}

Button.propTypes = {
    text:PropTypes.string,
    color:PropTypes.string,
    textColor:PropTypes.string,
    // onClick: PropTypes.func.isRequired
    onClick: PropTypes.func
}

export default Button