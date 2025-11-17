import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { useEffect, useState } from 'react';

function SelectWithLabel({
    label,
    id,
    placeholder,
    module,
    dataKey,
    col,
    ...props
}) {
    const [options, setOptions] = useState([]);

    useEffect(() => {
        fetch(`/api/v1/lookups/${dataKey}`)
            .then((response) => response.json()) // RETURN the parsed JSON
            .then((res) => {
                console.log('API response:', res.data); // Now you will see actual JSON
                if (res.status && res.data) {
                    // If data is an object, convert it to array of {label, value}
                    const options = Array.isArray(res.data)
                        ? res.data
                        : Object.entries(res.data).map(([value, label]) => ({
                              value,
                              label,
                          }));

                    setOptions(options);
                }
            })
            .catch((error) => {
                console.error('Error fetching select options:', error);
            });
    }, [dataKey]);

    return (
        <div className={`col-span-${col}`}>
            <Label htmlFor={id}>{label}</Label>
            <Select
                value={props.value || ''}
                onValueChange={(val) => {
                    props.onChange?.({
                        target: { name: props.name, value: val },
                    });
                }}
                onBlur={props.onBlur}
            >
                <SelectTrigger id={id}>
                    <SelectValue placeholder={placeholder || 'Select option'} />
                </SelectTrigger>
                <SelectContent>
                    {options.map((item) => (
                        <SelectItem key={item.value} value={item.value}>
                            {item.label}
                        </SelectItem>
                    ))}
                </SelectContent>
            </Select>
        </div>
    );
}

export { SelectWithLabel };
